<?php
/**
 * @lecms 安装引导
 * @DateTime 2019/11/7 13:30
 * @Author 晚安
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');
//定义目录分隔符
define("DS", DIRECTORY_SEPARATOR);

//定义项目目录
define('APP_PATH', dirname(dirname(__FILE__)) . DS . 'application' . DS);

//定义web根目录
define('WWW_ROOT', dirname(__FILE__) . DS);

//定义CMS名称
$sitename = "乐橙CMS";
$lockFile = "." . DS . "install" . DS . "install.lock";
if (is_file($lockFile)) {
    die("<script>alert('当前已经安装乐橙CMS，如果需要重新安装，请手动移除install/install.lock文件');</script>
	<script>window.location.href = '/'</script>");
}else {
    if (version_compare(PHP_VERSION, '5.6.0', '<')) {
	die("<script>alert('当前版本PHP版本过低，请使用PHP5.6以上版本！');</script>");
	}
}
if ($_GET['c'] = 'start' && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    //执行安装
    $host = isset($_POST['hostname']) ? $_POST['hostname'] : '127.0.0.1';
    $port = isset($_POST['port']) ? $_POST['port'] : '3306';
    //判断是否在主机头后面加上了端口号
    $hostData = explode(":", $host);
    if (isset($hostData) && $hostData && is_array($hostData) && count($hostData) > 1) {
        $host = $hostData[0];
        $port = $hostData[1];
    }
    //mysql的账户相关
    $mysqlUserName = isset($_POST['username']) ? $_POST['username'] : '';
    $mysqlPassword = isset($_POST['password']) ? $_POST['password'] : '';
    $mysqlDataBase = isset($_POST['database']) ? $_POST['database'] : '';
    //检测能否读取安装文件
    $sql = @file_get_contents(WWW_ROOT . DS . "install" . DS . 'lecms.sql');
    if (!$sql) {
        die("<script>alert('请检查install/lecms.sql是否有读取权限！');</script>");
    }
    //链接数据库
    $pdo = new PDO("mysql:host={$host};port={$port}", $mysqlUserName, $mysqlPassword, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
    // 连接数据库
    $link = @new mysqli("{$host}:{$port}", $mysqlUserName, $mysqlPassword);
    // 获取错误信息
    $error = $link->connect_error;
    if (!is_null($error)) {
        // 转义防止和alert中的引号冲突
        $error = addslashes($error);
        die("<script>alert('数据库链接失败:$error');history.go(-1)</script>");
    }
    // 设置字符集
    $link->query("SET NAMES 'utf8'");
    $link->server_info > 5.0 or die("<script>alert('请将您的mysql升级到5.0以上');history.go(-1)</script>");
    // 创建数据库并选中
    if (!$link->select_db($mysqlDataBase)) {
        $create_sql = 'CREATE DATABASE IF NOT EXISTS ' . $mysqlDataBase . ' DEFAULT CHARACTER SET utf8;';
        $link->query($create_sql) or die('创建数据库失败');
        $link->select_db($mysqlDataBase);
    }
    $sqlArr = explode(';', $sql);
    foreach ($sqlArr as $key => $val) {
        if ($val) {
            $link->query($val);
        }
    }
    $databaseConfig = include WWW_ROOT . DS . "config" . DS . "database.php";
    //替换数据库相关配置
    $databaseConfig['hostname'] = $host;
    $databaseConfig['database'] = $mysqlDataBase;
    $databaseConfig['username'] = $mysqlUserName;
    $databaseConfig['password'] = $mysqlPassword;
    $databaseConfig['hostport'] = $port;
    $putConfig = @file_put_contents(WWW_ROOT . DS . "config" . DS . "database.php", "<?php\nreturn \n" . var_export($databaseConfig, true) . "\n;");
    if (!$putConfig) {
        die("<script>alert('安装失败，请确定database.php是否有写入权限！:$error');history.go(-1)</script>");
    }
    $result = @file_put_contents($lockFile, 1);
    if (!$putConfig) {
        die("<script>alert('安装失败，请确定install.lock是否有写入权限！:$error');history.go(-1)</script>");
    }
    die("<script>alert('系统安装成功，后台地址为/admin，点击确定返回首页！');window.location.href = '/admin'</script>");
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>安装<?php echo $sitename; ?></title>
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
        html, body {
            height: 100%;
            background-image: url("./install/img/installbg.jpg");
            background-size: cover;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div style="margin: 0 auto;text-align: center;margin-top: 20px;">
                <img src="/install/img/logo.png" style="border-radius: 50%;">
            </div>
        </div>
        <div class="col-md-4 col-md-offset-4"
             style="margin-top: 20px;background-color: rgba(255,255,255,.5);padding: 30px;border-radius: 5px">
            <div id="cms-box">
                <form class="form-horizontal" action="./install.php?c=start" method="post">
                    <p style="font-size: 28px;font-weight: bolder;text-align: center;color: #fff;"><?= $sitename ?> 安装向导</p>
                    <div class="panel panel-default">
                        <div class="panel-heading">数据库相关设置--默认账号和密码：admin admin123</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">主机地址</label>
                                <div class="col-sm-10">
                                    <input type="text" name="hostname" class="form-control" value="127.0.0.1" placeholder="请输入主机地址、端口号可选">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">数据库名</label>
                                <div class="col-sm-10">
                                    <input type="text" name="database" class="form-control" placeholder="请输入数据库名">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">用户名</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" placeholder="请输入用户名">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" placeholder="请输入数据库密码">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success" style="width: 80%;">立即安装</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="./install/static/jquery.min.js"></script>
<script type="text/javascript" src="./install/static/jquery.ripples.js"></script>
<script type="text/javascript">
    $(function () {
        $('body').ripples({
            resolution: 512,
            dropRadius: 20, //px
            perturbance: 0.04,
        });
    });
</script>
</body>
</html>
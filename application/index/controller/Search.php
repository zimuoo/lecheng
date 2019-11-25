<?php
/**
 * @author  lecms
 * email: weigo521@163.com
 * wechat:weigo521 * Date: 2019/8/20
 * Time: 12:05
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Cache;
use app\index\controller\BaseService;
class Search extends BaseController
{
	private $systemConfig=null;
	private $service=null;
	public function __construct()
	{
		parent::__construct();
		$system =Db::table('system')->where('id',1)->find();
		$this->systemConfig=$system;
		$this->service=new BaseService();
		$this->assign('dibuNavData',config('dibu_nav'));
		$this->assign('isMb',isMobile());
		$this->assign('navData',$this->getNav());
		$this->assign('yuming',$_SERVER['SERVER_NAME']);
		$this->assign('systemConfig',$system);
		$this->assign('templatePath','/template/'.$system['vod_template'].'/');
	}
	public function getNav()
	{
		$data=Db::table('link')->where('open',1)->order('sort')->select();
		return $data;
	}
	public function index()
	{
	
		$systemConfig=$this->systemConfig;
		$type=$systemConfig['ziyuan_type'];
		$cacheTime=$systemConfig['vod_cache_time']*3600;//缓存时间
		$wd=trim(input('wd'));
		if (!cache(md5('search'.$wd))) {
			if($type==1){
				$data=$this->service->searchData($wd);
			}else{
				$data=$this->service->searchDatav10($wd);
				//dump($data);die;
			}

			cache(md5('search'.$wd),$data,$cacheTime);
		}else{
			$data=cache(md5('search'.$wd));
		}
		$this->assign('dyName','搜索《'.$wd."》");
		$this->assign('data',$data?$data:[]);
		return view("{$systemConfig['vod_template']}/html/vod/search");
	}
}
<?php
/**
 * @author  lecms
 * email: weigo521@163.com
 * wechat:weigo521 * Date: 2019/8/16
 * Time: 12:26
 * QQ群892570651
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Cache;
use app\index\controller\BaseService;
use app\index\controller\UpdateService;
class Index extends Controller
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
		$this->assign('templatePath','/'.'template/'.$system['vod_template'].'/');
	}
	public function getNav()
	{
		$data=Db::table('link')->where('open',1)->order('sort')->select();
		return $data;
	}
	public function getLink()
	{
		$data=Db::table('links')->where('open',1)->order('sort')->select();
		return $data;
	}
	public function index()
	{
		set_time_limit(0);
		$systemConfig=$this->systemConfig;
		$cacheTime=$systemConfig['vod_cache_time']*3600;//缓存时间
		//热推
		if (!cache('dy360_data_hot')) {
			$hotList=$this->service->getHotDy();
			cache('dy360_data_hot',$hotList,$cacheTime);
		}else{
			$hotList=cache('dy360_data_hot');
		}
		//dump($data360);die;
		$this->assign('retui',$hotList);
		//最新电影
		if (!cache('zuixin_data')) {
			$dy360Datazuixin=$this->service->get360zuixindy();
			$data360zuixin=$dy360Datazuixin;
			cache('zuixin_data',$dy360Datazuixin,$cacheTime);
		}else{
			$data360zuixin=cache('zuixin_data');
		}
		//dump($data360zuixin);die;
		$this->assign('linkData',$this->getLink());
		$this->assign('zuixin',$data360zuixin?$data360zuixin:[]);
		$this->assign('huandengpian',$this->getHuandengpianshouye());
		$this->assign('paihang',$this->getPaiHang());

		return view("{$systemConfig['vod_template']}/html/index/index");
	}

	public function getHuandengpianshouye()
	{
		$systemConfig=$this->systemConfig;
		$cacheTime=$systemConfig['vod_cache_time']*3600;//缓存时间
		$huan=cache('shouye_huandeng_bejson');
		if ($huan) {
			return $huan;
		}else{
			$data=$this->service->getHuanDeng();
			if (empty($data)) {
				$this->getHuandengpianshouye();
			}else{
				cache('shouye_huandeng_bejson',$data,3*$cacheTime);
				return $data;
			}
		}
	}

	public function getPaiHang()
	{
		$systemConfig=$this->systemConfig;
		$cacheTime=$systemConfig['vod_cache_time']*3600;//缓存时间
		
		if(!cache('paihangbang')){
			$service=$this->service;
			$data=$service->getPaiHang();
			cache('paihangbang',$data,$cacheTime);
		}else{
			$data=cache('paihangbang');
		}
		
		return $data;
		
	}
	//360电影列表
	public function zblist()
	{
		$systemConfig=$this->systemConfig;
		$data=config('zb_list');
		$newData=[];
		foreach ($data as $key => $value) {
			if ($value['type']=='mx') {
				$newData['mx'][$key]=$value;
			}elseif ($value['type']=='ws') {
				$newData['ws'][$key]=$value;
			}elseif ($value['type']=='tv') {
				$newData['tv'][$key]=$value;
			}elseif ($value['type']=='zj') {
				$newData['zj'][$key]=$value;
			}
		}
		//dump($newData);die;
		$this->assign('data',$newData?$newData:[]);
		return view("{$systemConfig['vod_template']}/html/zb/live");
	}
	public function music()
	{
		$systemConfig=$this->systemConfig;
		return view("{$systemConfig['vod_template']}/html/music/index");
	}

	public function taobao()
	{
		$systemConfig=$this->systemConfig;
		return view("{$systemConfig['vod_template']}/html/taobao/index");
	}
	public function book()
	{
		set_time_limit(0);
		$systemConfig=$this->systemConfig;
		if(cache('xstui')){
			$data=cache('xstui');
		}else{
			$data=$this->service->getBookHot();
			cache('xstui',$data,7*24*3600);
		}
		
		$this->assign('list',$this->bookList1());
		$this->assign('data',$data);
		return view("{$systemConfig['vod_template']}/html/book/index");
	}

	public function bookList1()
	{
		$type=input('type')?input('type'):1;
		$page=input('page')?input('page'):1;
		if(cache(md5('yp'.$type.$page))){
		 	$data=cache(md5('yp'.$type.$page));
		 }else{
			$data=$this->service->getBookList($type,$page);
		 	cache(md5('yp'.$type.$page),$data,8*3600);
		 }
		return $data;
	}

	public function bookList()
	{
		$systemConfig=$this->systemConfig;
		$type=input('type')?input('type'):1;
		$page=input('page')?input('page'):1;
		 if(cache(md5('yp'.$type.$page))){
		 	$data=cache(md5('yp'.$type.$page));
		 }else{
			$data=$this->service->getBookList($type,$page);
		 	cache(md5('yp'.$type.$page),$data,8*3600);
		 }

		$this->assign('page',$page);
		$this->assign('list',$data);
		return view("{$systemConfig['vod_template']}/html/book/booklist");
		//return $data;
	}

	public function bookDetail()
	{
		$systemConfig=$this->systemConfig;
		$bookId=input('bId');


		$data=$this->getbookdetail($bookId);

        $this->assign('bId',$bookId);
		$this->assign('data',$data);
		return view("{$systemConfig['vod_template']}/html/book/bookdetail");

	}
	public function bookkan()
	{
		$systemConfig=$this->systemConfig;
		$zId=input('zId');
		if(strpos($zId,'html')){
			
			$zId=base64_encode($zId);
		}
		$bId=input('bId');//书id
		
		// if(strpos($bId,'.html') ===false){
		// 	$bId=base64_decode($bId);
		// }
		$zhangName=input('zhangName');
		$bookName=input('bookName');
		
		if(cache(md5($zId))){
			$data=cache(md5($zId));
		}else{
			$data=$this->service->getBookZhang($zId);
			cache(md5($zId),$data,7*3600);
		}
		 $bookZhang=$this->getbookdetail($bId);
		// dump($bookZhang);die;
		$shu=count($bookZhang['list'])-1;
		 foreach($bookZhang['list'] as $k=>$v){
		 	if($v['link']==base64_decode($zId)){
		 		$upyelink=isset($bookZhang['list'][$k-1]['link'])?base64_encode($bookZhang['list'][$k-1]['link']):base64_encode($bookZhang['list'][0]['link']);
		 		$upyeZhang=isset($bookZhang['list'][$k-1]['zhang'])?$bookZhang['list'][$k-1]['zhang']:$bookZhang['list'][0]['zhang'];
		 		
		 		$nextlink=isset($bookZhang['list'][$k+1]['link'])?base64_encode($bookZhang['list'][$k+1]['link']):base64_encode($bookZhang['list'][$shu]['link']);
		 		$nextZhang=isset($bookZhang['list'][$k+1]['zhang'])?$bookZhang['list'][$k+1]['zhang']:$bookZhang['list'][$shu]['zhang'];
		 		
		 	}
		 }
		 $this->assign('zId',$zId);
		$this->assign('bId',$bId);
		$this->assign('upyelink',$upyelink);
		$this->assign('upyeZhang',$upyeZhang);
		$this->assign('nextlink',$nextlink);
		$this->assign('nextZhang',$nextZhang);
		$this->assign('data',$data[0]);
		$this->assign('bookName',$bookName);
		$this->assign('zhangName',$zhangName);
		
		return view("{$systemConfig['vod_template']}/html/book/bookkan");
	}
	
	public function getbookdetail($bookId='')
	{
		$bookId=input('bId')?input('bId'):$bookId;
		
		if(cache(md5($bookId))){
			$data=cache(md5($bookId));
		}else{
			$data=$this->service->getBookDetail($bookId);
			cache(md5($bookId),$data,12*3600);
		}
	//	$service=new BaseService();
	//	$data=$service->getBookDetail($bookId);
		return $data;
	}
	
	public function getbookdetailAjax($bookId='')
	{
		$bookId=input('bId')?input('bId'):$bookId;
		
		if(cache(md5($bookId.'AJAX'))){
			$data=cache(md5($bookId));
		}else{
			$data=$this->service->getBookDetail($bookId);
			foreach($data['list'] as &$v){
				$v['link']=base64_encode($v['link']);
			}
			cache(md5($bookId.'AJAX'),$data,12*3600);
		}
	//	$service=new BaseService();
	//	$data=$service->getBookDetail($bookId);
		return $data;
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


	public function testt()
	{
		$a=$this->service->tvOrDongManOrZongYi('/tv/PbRuc07lRmPuM3.html');
		dump($a);
	}

	
}

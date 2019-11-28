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
use think\Log;
use app\index\controller\BaseService;
class Play extends Controller
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
		set_time_limit(0);
		$systemConfig=$this->systemConfig;
		$urlorId=base64_decode(input('url'));
		$data=explode('/', $urlorId);
		$cacheTime=$systemConfig['vod_cache_time']*3600;//缓存时间
		$service=$this->service;
		$type=$systemConfig['ziyuan_type'];
		# 资源站资源
		if(!cache(md5($urlorId))){
				if($type==1){
					$data1=$service->getcxplayData($data[2]);
				}else{
					$data1=$service->getcxplayDatav10($data[2]);
				}
			cache(md5($urlorId),$data1,$cacheTime);
			$data=$data1;
		}else{
			$data=cache(md5($urlorId));
		}
		$str=$data['other']['list_name'];
		$content=$data['other']['vod_content'];
		$data['other']['list_name']=preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si","",$str);
		$data['other']['vod_content']=preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si","",$content);
		//dump($data);die;
		$this->assign('dyName',$data['dyName']);
		$this->assign('playData',$data);
		$this->assign('isDy',2);
		$this->assign('isZY',2);
		return view("{$systemConfig['vod_template']}/html/vod/play");

	}

	//调取资源站进行播放

	public function play()
	{
		set_time_limit(0);
		$service = $this->service;
		$systemConfig=$this->systemConfig;
		$wd = trim(input('wd'));
		$type=$systemConfig['ziyuan_type'];
		$urlorId = base64_decode(input('url'));
		$urlEx = explode('/', $urlorId);
		$playUrl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if($systemConfig['wechat_qq_open_close']==1 && $this->weChatOrQq()){
			$this->assign('url',$service->rrd(urlencode($playUrl))['url']);
			return view("{$systemConfig['vod_template']}/html/vod/browser");
		}else {
			$cacheTime=$systemConfig['vod_cache_time']*3600;//缓存时间
			if (!cache(md5($wd.$urlorId))) {			
				if ($systemConfig['vod_yunplay_switch'] == 2 && $systemConfig['vod_quan_switch'] == 1) {
					$data = $this->getYuanZy($urlEx[1], $urlorId);
					$isYunBo=2; //是云播
					if (empty($data['playData'])) {
						switch ($type) {
							case 1:
								$data = $service->getYunData($wd);
								break;
							
							default:
								$data = $service->getYunDatav10($wd);
								break;
						}
						$isYunBo=1;
					}
					
				}else {
					switch ($type) {
							case 1:
								$data = $service->getYunData($wd);
								break;
							
							default:
								$data = $service->getYunDatav10($wd);
								break;
						}
						$isYunBo=1;
						//资源站没有的话 就用原生
						if (empty($data['playData'])) {
							$data = $this->getYuanZy($urlEx[1], $urlorId);
							$isYunBo=2;
						}
					
				}
				
				cache(md5($wd.$urlorId), $data, $cacheTime);
				cache('isYunBo', $isYunBo, $cacheTime);
			} else {
				$data = cache(md5($wd.$urlorId));
				$isYunBo=cache('isYunBo');
			}
			//dump($data)die;
			//如果是电影的话，列表改变
			if ($urlEx[1] == 'm') {
				if(!empty($data['playData'])){
					foreach ($data['playData'] as $key => $value) {
					foreach ($value['urlData'] as $k => $v) {

							$newData[$key]['playType'] = $value['playType'] . (count($value['urlData']) > 1 ? ($k + 1) : '');
							$newData[$key]['url'] = $v['lianjie'];
						}
					}
					$data['playData'] = $newData;
				}				
			}
			$str=$data['other']['list_name'];
			$content=$data['other']['vod_content'];
			$data['other']['list_name']=preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si","",$str);
			$data['other']['vod_content']=preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si","",$content);
		//	dump($data);die;
			$this->assign('isYunBo',$isYunBo);
			$this->assign('dyName', $wd);
			$this->assign('isDy', $urlEx[1] == 'm' ? 1 : 2);
			$this->assign('isZY',$urlEx[1] == 'va'?1:2);
			$this->assign('playData', $data?$data:[]);

			return view("{$systemConfig['vod_template']}/html/vod/play");
		}

	}


	public function cxplay()
	{
		$systemConfig=$this->systemConfig;
		$type=$systemConfig['ziyuan_type'];
		$service=$this->service;
		$urlorId=base64_decode(input('url'));
		if($type==1){
			# 资源站资源
			$data=$service->getcxplayData($urlorId);
			//dump($data);die;
			$this->assign('dyName',$data['dyName']);
			$this->assign('isDy',2);
			$this->assign('isYunBo',1);
			$this->assign('playData',$data?$data:[]);
			return view("{$systemConfig['vod_template']}/html/vod/play");
		}else{
			//V10资源站
			$data=$service->getcxplayDatav10($urlorId);
			//dump($data);die;
			$this->assign('dyName',$data['dyName']);
			$this->assign('isDy',2);
			$this->assign('isYunBo',1);
			$this->assign('playData',$data?$data:[]);
			return view("{$systemConfig['vod_template']}/html/vod/play");
		}	
	}

	public function zzplay()
	{
		$systemConfig=$this->systemConfig;
		$urlorId=base64_decode(input('url'));
		$data=$this->getZPlayData($urlorId);
			//dump($data);die;
		$this->assign('dyName',$data['dyName']);
		$this->assign('isDy',2);
		$this->assign('isYunBo',1);
		$this->assign('playData',$data?$data:[]);
		return view("{$systemConfig['vod_template']}/html/vod/play");
		
	}
	public function getZPlayData($vid=1)
	{
		$data=Db::table('le_vod')->where(array('vod_id'=>$vid))->find();
		$data['list_name']=$this->getType($vid);

		if ($data) {
			$dyName=$data['vod_name'];
				if(strpos($data['vod_play_url'],'.m3u8')) {
					$playUrlData = explode('$$$', $data['vod_play_url']);
					foreach($playUrlData as $k1=>$v1){
						if(strpos($v1,'.m3u8')){
							$url1=str_replace("\r\n", '',$v1);
						}
					}
					$url2=explode('.m3u8',$url1);
					foreach($url2 as $k2=>&$v2){
						if($v2 !=''){
							$v2=trim(strrchr($v2, '$'),'$').'.m3u8';
							$url3[]['lianjie']=$v2;
						}else{
							unset($url2[$k2]);
						}
					}
				}
		}
		return ['dyName'=>$dyName,'other'=>$data,'playData'=>[['playType'=>'官方云播','urlData'=>$url3]]];
	}
	public function getType($tid)
    {
    	$typeData=db('le_type')->where('type_id',$tid)->find();
    	return $typeData['type_name'];
    }

	public function getYuanZy($type,$url)
	{
		$service = $this->service;
		$data=[];
		if ($type == 'm') {
			# 360资源
			$data = $service->getDianYing($url);
			//dump($data);die;
		} elseif ($type == 'tv') {
			$data = $service->tvOrDongManOrZongYiNew($url);
		//	dump($data);die;

		} elseif ($type == 'ct') {
			$data = $service->tvOrDongManOrZongYiNew($url);

		}  elseif ($type == 'va') {
			$data = $service->tvOrDongManOrZongYiNew($url);
			//	dump($data);die;
			
			foreach($this->more_array_unique($data['zongyi']) as $k=>&$v){
				$urlData[$k]['url']=$v['lianjie'];
				$urlData[$k]['qishu']=$v['qishu'];
			}
			
			$data['playData'][0]['playType']="官方";
			$data['playData'][0]['urlData']=$urlData;
			$data['playData'][0]['zongyi']=$urlData;
		//	dump($data['playData'][0]['urlData'][0]['url']);die;
		}else{
			$data = $service->tvOrDongManOrZongYi($url);
		}
	//	dump($data);die;
		return $data;
	}
	public function more_array_unique($arr)
	{
	    //先把二维数组中的内层数组的键值记录在在一维数组中
	    foreach ($arr[0] as $k => $v) {
	        $arr_inner_key[] = $k;
	    }
	    foreach ($arr as $k => $v) {
	        //降维 用implode()也行
	        $v = join(",", $v);
	        //保留原来的键值 $temp[]即为不保留原来键值
	        $temp[$k] = $v;
	    }
	    //去重：去掉重复的元素
	    $temp = array_unique($temp);
	    foreach ($temp as $k => $v) {
	        $a = explode(",", $v);
	        $arr_after[$k] = array_combine($arr_inner_key, $a);
	    }
	    return $arr_after;
	}
	public function weChatOrQq()
	{
			if(strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !==false || strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/') !== false){

				return true;
			}else{
				return false;
			}
	}

}
<?php
/**
 * @author  lecms
 * email: weigo521@163.com
 * wechat:weigo521 * Date: 2019/8/30
 * Time: 17:51
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Cache;
use app\index\controller\BaseService;
class Type extends Controller
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
		//$service=new BaseService();
		$systemConfig=$this->systemConfig; //系统数据
		$cacheTime=$systemConfig['vod_cache_time']*3600;//缓存时间
		$dyType=config('vod_type');
		$dyArea=config('vod_area');
		$vodType=intval(input('vodType')); //vodType,1为电影，2电视剧，3综艺，4动漫
		if($vodType ==1){
			$vodTypeName="电影";
			$typeData=$dyType['电影'];
			$areaData=$dyArea['电影'];
		}else if($vodType ==2){
			$vodTypeName="电视剧";
			$typeData=$dyType['电视剧'];
			$areaData=$dyArea['电视剧'];
		}else if($vodType ==3){
			$vodTypeName="综艺";
			$typeData=$dyType['综艺'];
			$areaData=$dyArea['综艺'];
		}else if($vodType ==4){
			$vodTypeName="动漫";
			$typeData=$dyType['动漫'];
			$areaData=$dyArea['动漫'];
		}else{
			$vodTypeName="电影";
			$typeData=$dyType['电影'];
			$areaData=$dyArea['电影'];
		}

		$typeId=input('typeId')?input('typeId'):'all';//类型
		$dyTime=input('dyTime')?input('dyTime'):'all';//时间
		$area=input('area')?input('area'):'all';//地区
		$page=input('page')?intval(input('page')):1;//页数

		//当前年份
		$year=date('Y',time());
		//获取数据
		$cacheKey=md5($vodType.$dyTime.$area.$typeId.$page);
		if (!cache($cacheKey)) {
			$data=$this->service->getListDataByTypeId($vodType,$dyTime,$area,$typeId,$page);
			cache($cacheKey,$data,$cacheTime);
		}else{
			$data=cache($cacheKey);
		}
		

		//$totalCount=$data['data']['total'];
		//$pageSize=count($data['data']['list']);
		$totalPages=$data['page'];
		//dump($data);die;

		$this->assign('page',$page); //当前页数
		$this->assign('totalPages',$totalPages); //总页数
		$this->assign('vodTypeName',$vodTypeName);
		$this->assign('nowYear',intval($year));
		$this->assign('endYear',intval($year)-5);
		$this->assign('typeId',$typeId);
		$this->assign('vodType',$vodType);
		$this->assign('dyTime',$dyTime);
		$this->assign('typeData',$typeData);
		$this->assign('area',$area);
		$this->assign('areaData',$areaData);
		$this->assign('listData',$data['list']);
		return view("{$systemConfig['vod_template']}/html/vod/show");
	}

	public function cxlist()
	{
		$page=input('page')?intval(input('page')):1;//页数
		$cid=input('cid')?intval(input('cid')):'';
		$systemConfig=$this->systemConfig; //系统数据
		$type=$systemConfig['ziyuan_type'];
		//$service=new BaseService();
		if($type==1){
			$data=$this->service->getcxdy($page,$cid);
			$this->assign('vodTypeName','尝鲜电影');
			$this->assign('typeId',$cid);
			$this->assign('page',$page); //当前页数
			$this->assign('listData',isset($data['data'])?$data['data']:[]);
			$this->assign('typeData',$data['list']);
			$this->assign('totalPages',$data['page']['pagecount']); //总页数
			return view("{$systemConfig['vod_template']}/html/vod/cx");
		}else{
			$data=$this->service->getcxdyv10($page,$cid);
			
			//dump($data);die;
			$this->assign('vodTypeName','尝鲜电影');
			$this->assign('typeId',$cid);
			$this->assign('page',$page); //当前页数
			$this->assign('listData',isset($data['data']['list'])?$data['data']['list']:[]);
			$this->assign('typeData',$data['type']);
			$this->assign('totalPages',$data['data']['pagecount']); //总页数
			return view("{$systemConfig['vod_template']}/html/vod/cxmac");
			
		}
	}
	 public function huya()
		{
			$systemConfig=$this->systemConfig; //系统数据
			$cacheTime=$systemConfig['vod_cache_time']*3600;//缓存时间
			$cid=input('cid')?input('cid'):2135;
			$page=input('page')?input('page'):1;
			if(!cache(md5('HUYATYPE'))){
				$typeData=BaseService::getHuyaTypeData();
				cache('HUYATYPE',$typeData,$cacheTime);
			}else{
				$typeData=cache('HUYATYPE');
			}
			
			$listData=$this->getHuyaList($cid,$page);
			//dump($page);die;
			$this->assign('huyaType',$typeData);
			$this->assign('listData',$listData);
			$this->assign('cid',$cid);
			$this->assign('page',$page);
			$this->assign('totalPages',$listData['data']['totalPage']);
			return view("{$systemConfig['vod_template']}/html/vod/huya");
		}
	public function getHuyaList($cid=2135,$page=1)
	{
		$systemConfig=$this->systemConfig; //系统数据
		$cacheTime=$systemConfig['vod_cache_time']*3600;//缓存时间
		if(!cache(md5('HuyaTypeBY'.$cid.$page))){
			$lisData=BaseService::getHuyaListData($cid,$page);
			cache('HuyaType',$listData,$cacheTime);
		}else{
			$lisData=cache(md5('HuyaTypeBY'.$cid.$page));
		}
			$lisData=BaseService::getHuyaListData($cid,$page);
		return $lisData;
	}
	
	public function zztj()
	{
		$page=input('page')?intval(input('page')):1;//页数
		$cid=input('cid')?intval(input('cid')):0;
		$systemConfig=$this->systemConfig; //系统数据
		
		//$data=$this->service->getcxdy($page,$cid);

		$data=$this->getZZData($page,$cid);
		$this->assign('vodTypeName','站长推荐');
		$this->assign('typeId',$cid);
		$this->assign('page',$page); //当前页数
		$this->assign('listData',isset($data['list'])?$data['list']:[]);
		$this->assign('typeData',$this->getZZType());
		$this->assign('totalPages',$data['totalPage']); //总页数
		return view("{$systemConfig['vod_template']}/html/vod/zz");
		
	}
	
	public function getZZType()
	{
		$data=Db::table('le_type')->where(['open'=>1])->select();
		
		if($data){
			foreach ($data as &$v){
				$v['list_name']=$v['type_name'];
				$v['list_id']=$v['type_id'];
			}
		}
	
		return $data;
	}
	public function getZZData($pageNo=1,$cid=0)
	{
		$pageSize=28;//每页数据数量
		$page=($pageNo-1)*$pageSize;
		if($cid !=0){
			$total=Db::table('le_vod')->where(array('type_id' => $cid,'open'=>1))->select();
			$list=Db::table('le_vod')->where(array('type_id' => $cid,'open'=>1))->limit($page,$pageSize)->select();
		}else{
			$total=Db::table('le_vod')->where(array('open'=>1))->select();
			$list=Db::table('le_vod')->where(array('open'=>1))->limit($page,$pageSize)->select();
		}
		
		
		// $data['total']=ceil($list->total() / $pageSize);
		// $data['totalPage']=ceil($data->total() / 10);
		$data = [
            'total'     => count($total),         // 总记录数
            'page'       => $pageNo,   // 当前页码
            'size'      => $pageSize,      // 每页记录数
            'totalPage' => ceil(count($total) / $pageSize),
            'list'      => $list          // 分页数据
        ];
        
		return $data;
	}
}
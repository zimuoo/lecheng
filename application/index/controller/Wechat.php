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
class Wechat extends BaseController
{
	
	public function index()
	{
		if (isset($_GET['echostr'])) {
			$this->valid();
		}else {
			$this->responseMsg();
		}
	}

	public function valid() {
		$echoStr = $_GET["echostr"];
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}
	private function checkSignature()
	{
		$wxData=$this->getWx();
		
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$token = $wxData['token'];
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	public function responseMsg() {
		$postStr = @file_get_contents("php://input");
		if (!empty($postStr)) {
			libxml_disable_entity_loader(true);
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$postType = trim($postObj->MsgType);
			switch ($postType) {
				case 'text':
					$res = $this->receiveText($postObj);
					break;
				case 'image':
					$res = $this->receiveImage($postObj);
					break;
				case 'location':
					$res = $this->receiveLocation($postObj);
					break;
				case 'voice':
					$res = $this->receiveVoice($postObj);
					break;
				case 'video':
					$res = $this->receiveVideo($postObj);
					break;
				case 'link':
					$res = $this->receiveLink($postObj);
					break;
				case 'event':
					$res = $this->receiveEvent($postObj);
					break;
				default:
					$res = 'unknow msg type: '.$postType;
					break;
			}
			echo $res;
		}
		else{
			echo 'other msg';
			exit;
		}
	}
	private function receiveLink($object) {
		$msg = '你发送的是链接已收到，请等待处理';
		$res = $this->transmitText($object, $msg);
		return $res;
	}
	private function getWx()
	{
		$info = Db::table('wx_mp')->where([ 'key' => 'SHOPWCHAT'])->field('value')->find();
		$data=json_decode($info['value'],true);
		return $data;
	}
	private function receiveText($object) {
		$content = trim($object->Content);
		$txt = '请点击下方链接：'. "\n";
		//	$res = model('Vod')->listCacheData($param);
		$service=new BaseService();
		$res=$service->searchData($content);
			$data = [];
			
			$wxData=$this->getWx();
			if(empty($res['quanData']) && empty($res['zyData'])){

				//没找到资源
				$txt .=  '抱歉未找到影视资源' . "\n";
				$data[] = array('Title'=>'抱歉未找到影视资源', 'Description'=>$wxData['noDataDesc'], 'PicUrl'=>$wxData['noDataPic'], 'Url'=>"http://".$wxData['searchUrl']);
			}else{
				/*foreach ($res['list'] as $k => $v) {

					$url = $this->_conf['sousuo'] . mac_url_vod_detail($v);
					if ($this->_conf['bofang'] > 0) {
						$url = $this->_conf['sousuo'] . mac_url_vod_play($v, ['sid' => 1, 'nid' => 1]);
					}
					if (substr($v['vod_pic'], 0, 4) == 'http' || substr($v['vod_pic'], 0, 4) == 'mac:') {
						$picUrl = mac_url_img($v['vod_pic']);
					} else {
						$picUrl = $this->_conf['sousuo'] . "/" . $v['vod_pic'];
					}
					//  $txt .= '<a href="' . $url . '">' . ($k + 1) . ',' . $v['vod_name'] . ' ' . $v['vod_remarks'] . '</a>' . "\n";
					$data[] = array('Title' => $v['vod_name'], 'Description' => mac_substring(strip_tags($v["vod_content"]), 20), 'PicUrl' => $picUrl, 'Url' => $url);
				}*/
				if (!empty($res['quanData'])) {
					$pic=$res['quanData'][0]['pic'];
				}else{
					$pic=$res['zyData'][0]['vod_pic'];
				}
				$data[] = array('Title' => '影视《'.$content."》已找到，点击观看", 'Description' => "全网最新影视资源免费看", 'PicUrl' =>$pic,'Url' => "http://".$wxData['searchUrl']."/index/search/index?wd=".$content);
			}
		$r = $this->transmitNews($object, $data);
		/*if (is_array($data)){
			if ( $this->_conf['msgtype'] !=1 && isset($data[0])){
				$r = $this->transmitNews($object, $data);
			}
			else{
				$r = $this->transmitText($object, $txt);
			}
		}*/
		return $r;
	}

	private function receiveEvent($object) {
		$guanzhu = $this->_conf['guanzhu'];
		$msg = '';
		switch ($object->Event) {
			case 'subscribe':
				$msg = $guanzhu;
				break;
			case 'unsubscribe':
				$msg = '拜拜了您内~';
				break;
			case 'CLICK':
				switch ($object->EventKey) {
					default:
						$res = '你点击了: '.$object->EventKey;
						break;
				}
				break;
			default:
				$msg = 'receive a new event: '.$object->Event;
				break;
		}
		$res = $this->transmitText($object, $msg);
		return $res;
	}
	private function transmitText($object, $content) {
		$xmlTpl = '<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>';
		$res = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
		return $res;
	}
	private function transmitNews($object, $newsArray) {
		if (!is_array($newsArray)) {
			return;
		}
		$itemTpl = '<item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>';
		$item_str = '';
		foreach($newsArray as $item) {
			$item_str.= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
		}
		$xmlTpl = '<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <ArticleCount>%s</ArticleCount>
        <Articles>%s</Articles>
        </xml>';
		$res = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray),$item_str);
		return $res;
	}

	private function transmitImage($object, $imageArray) {
		$xmlTpl = '<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[image]]></MsgType>
            <Image>
            <MediaId><![CDATA[%s]]></MediaId>
            </Image>
            </xml>';

		$res = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $imageArray['MediaId']);
		return $res;
	}

}
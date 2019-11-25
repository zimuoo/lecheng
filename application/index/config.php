<?php
/**
 * @author  乐橙CMS
 * email: weigo521@163.com
 * wechat:weigo521 * Date: 2019/9/4
 * Time: 15:01
 * QQ:296528828
 */
return [
	'lecms_version'=>'3.0.0',
	
	'vod_type'        =>[

		'电影'=>[
			103=>'喜剧',
			100=>'爱情',
			106=>'动作',
			102=>'恐怖',
			104=>'科幻',
			112=>'剧情',
			105=>'犯罪',
			113=>'奇幻',
			108=>'战争',
			115=>'悬疑',
			107=>'动画',
			117=>'文艺',
			118=>'纪录',
			119=>'传记',
			120=>'歌舞',
			121=>'古装',
			122=>'历史',
			123=>'惊悚',
			//     'other'=>'其他'
		],
		'电视剧'=>[
			'101'=>'言情',
			'105'=>'伦理',
			'109'=>'喜剧',
			'108'=>'悬疑',
			'111'=>'都市',
			'100'=>'偶像',
			'104'=>'古装',
			'107'=>'军事',
			'103'=>'警匪',
			'112'=>'历史',
			'106'=>'武侠',
			'113'=>'科幻',
			'114'=>'情景',
			'115'=>'动作',
			'116'=>'励志',
			'117'=>'神话',
			'118'=>'谍战',
			//   'other'=>'其他'
		],
		'综艺'=>[
			'121'=>'脱口秀',
			'120'=>'真人秀',
			'101'=>'选秀',
			'102'=>'八卦',
			'103'=>'访谈',
			'104'=>'情感',
			'105'=>'生活',
			'106'=>'晚会',
			'107'=>'搞笑',
			'108'=>'音乐',
			'109'=>'时尚',
			'110'=>'游戏',
			'111'=>'少儿',
			'112'=>'体育',
			'113'=>'纪实',
			'114'=>'科教',
			'115'=>'曲艺',
			'116'=>'歌舞',
			'117'=>'财经',
			'118'=>'汽车',
			'119'=>'播报'
		],
		'动漫'=>[
			'100'=>'热血',
			'134'=>'科幻',
			'102'=>'美少女',
			'109'=>'魔幻',
			'135'=>'经典',
			'136'=>'励志',
			'111'=>'少儿',
			'107'=>'冒险',
			'105'=>'搞笑',
			'137'=>'推理',
			'101'=>'恋爱',
			'138'=>'治愈',
			'106'=>'幻想',
			'104'=>'校园',
			'110'=>'动物',
			'112'=>'机战',
			'131'=>'亲子',
			'139'=>'儿歌',
			'103'=>'运动',
			'108'=>'悬疑',
			'113'=>'怪物',
			'115'=>'战争',
			'114'=>'益智',
			'123'=>'青春',
			'121'=>'童话',
			'119'=>'竞技',
			'126'=>'动作',
			'116'=>'社会',
			'117'=>'友情',
			'127'=>'真人版',
			'130'=>'电影版',
			'128'=>'OVA版',
			'129'=>'TV版',
			'132'=>'新番动画',
			'133'=>'完结动画'
		],
	],
	'vod_area'=>[
		'电影'=>[
			'11'=>'美国',
			'10'=>'大陆',
			'15'=>'香港',
			'13'=>'韩国',
			'14'=>'日本',
			'12'=>'法国',
			'16'=>'英国',
			'17'=>'德国',
			'18'=>'台湾',
			'21'=>'泰国',
			'22'=>'印度',

		],
		'电视剧'=>[
			'10'=>'大陆',
			'11'=>'香港',
			'16'=>'台湾',
			'12'=>'韩国',
			'14'=>'泰国',
			'15'=>'日本',
			'13'=>'美国',
			'17'=>'英国',
			'18'=>'新加坡',
		],
		'综艺'=>[
			'10'=>'大陆',
			'11'=>'台湾',
			'12'=>'韩国',
			'13'=>'日本',
			'14'=>'欧美',
			'15'=>'香港',
		],
		'动漫'=>[
			'11'=>'日本',
			'12'=>'美国',
			'10'=>'大陆',
		],

	],
	'dibu_nav'=>[
		//不能超过5个
		['title'=>'首页','url'=>'/'],['title'=>'尝鲜','url'=>'/index/type/cxlist'],['title'=>'小说','url'=>'/index/index/book'],['title'=>'直播','url'=>'/index/index/zblist'],['title'=>'音乐','url'=>'/index/index/music']
	],

	'title_replace' =>
		[
			'独播',
			'全集',
			'高清在线观看',
			'英语版',
			'英文版',
			'国语版',
			'原声版',
			'普通话版',
			'《',
			'》',
			'【',
			'】',
			'（',
			'）',
			'(',
			')',
		],
	'updateLog'=>"<fieldset class=\"layui-elem-field layui-field-title\" style=\"margin-top: 30px;\">
        <legend>版本更新记录：</legend>
    </fieldset><ul class=\"layui-timeline\">

    	<li class=\"layui-timeline-item\">
		    <i class=\"layui-icon layui-timeline-axis\">&#xe63f;</i>
		    <div class=\"layui-timeline-content layui-text\">
		      <h3 class=\"layui-timeline-title\">2019.09.10乐橙CMS 2.0.2</h3>
		      <ul>
		        <li>添加底部菜单</li>
		        <li>新增直播、音乐功能。请在后台 [系统管理--导航管理] 将菜单打开</li>
		      </ul>
		    </div>
  		</li>
        <li class=\"layui-timeline-item\">
            <i class=\"layui-icon layui-timeline-axis\"></i>
            <div class=\"layui-timeline-content layui-text\">
                <h3 class=\"layui-timeline-title\">2019年9月，乐橙CMS 2.0 发布。并发展成为最受欢迎的内容管理系统（期望）</h3>
            </div>
        </li>
        <li class=\"layui-timeline-item\">
            <i class=\"layui-icon layui-timeline-axis\"></i>
            <div class=\"layui-timeline-content layui-text\">
                <h3 class=\"layui-timeline-title\">2019年初，乐橙CMS 首个版本内测</h3>
            </div>
        </li>
        <li class=\"layui-timeline-item\">
            <i class=\"layui-icon layui-timeline-axis\"></i>
            <div class=\"layui-timeline-content layui-text\">
                <h3 class=\"layui-timeline-title\">2018年，乐橙CMS 孵化</h3>
            </div>
        </li>
        <li class=\"layui-timeline-item\">
            <i class=\"layui-icon layui-anim layui-anim-rotate layui-anim-loop layui-timeline-axis\"></i>
            <div class=\"layui-timeline-content layui-text\">
                <h3 class=\"layui-timeline-title\">更久前，轮子时代。那时候我们正在筹划着。。。</h3>
            </div>
        </li>
        <li class=\"layui-timeline-item\">
            <i class=\"layui-icon layui-anim layui-anim-rotate layui-anim-loop layui-timeline-axis\"></i>
            <div class=\"layui-timeline-content layui-text\">
                <h3 class=\"layui-timeline-title\">QQ交流群：892570651  如果远程升级有问题，请加QQ群</h3>
            </div>
        </li>
    </ul>",
    'zb_list'=>[
  ['title' => 'CCTV-1','img' => '/template/stui13/statics/tv/c1.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv1hd.m3u8','id' => '90','type' => 'tv'],
  ['title' => 'CCTV-2','img' => '/template/stui13/statics/tv/c2.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv2.m3u8','id' => '44','type' => 'tv'],
  ['title' => 'CCTV-3','img' => '/template/stui13/statics/tv/c3.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv3hd.m3u8','id' => '45','type' => 'tv'],
  ['title' => 'CCTV-4','img' => '/template/stui13/statics/tv/c4.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv4.m3u8','id' => '46','type' => 'tv'],
  ['title' => 'CCTV-5','img' => '/template/stui13/statics/tv/c5.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv5hd.m3u8','id' => '47','type' => 'tv'],
  ['title' => 'CCTV-5+','img' => '/template/stui13/statics/tv/c5.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv5phd.m3u8','id' => '48','type' => 'tv'],
  ['title' => 'CCTV-6','img' => '/template/stui13/statics/tv/c6.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv6hd.m3u8','id' => '49','type' => 'tv'],
  ['title' => 'CCTV-7','img' => '/template/stui13/statics/tv/c7.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv7.m3u8','id' => '50','type' => 'tv'],
  ['title' => 'CCTV-8','img' => '/template/stui13/statics/tv/c8.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv8hd.m3u8','id' => '51','type' => 'tv'],
  ['title' => 'CCTV-9','img' => '/template/stui13/statics/tv/c9.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv9.m3u8','id' => '52','type' => 'tv'],
  ['title' => 'CCTV-10','img' => '/template/stui13/statics/tv/c10.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv10.m3u8','id' => '3','type' => 'tv'],
  ['title' => 'CCTV-11','img' => '/template/stui13/statics/tv/c11.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv11.m3u8','id' => '39','type' => 'tv'],
  ['title' => 'CCTV-12','img' => '/template/stui13/statics/tv/c12.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv12.m3u8','id' => '40','type' => 'tv'],
  ['title' => 'CCTV-13','img' => '/template/stui13/statics/tv/c13.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv13.m3u8','id' => '41','type' => 'tv'],
  ['title' => 'CCTV-14','img' => '/template/stui13/statics/tv/c14.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv14.m3u8','id' => '42','type' => 'tv'],
  ['title' => 'CCTV-15','img' => '/template/stui13/statics/tv/c15.png','url' => 'http://ivi.bupt.edu.cn/hls/cctv15.m3u8','id' => '43','type' => 'tv'],
  ['title' => '丧尸电影','img' => 'http://himg2.huanqiu.com/attachment2010/2016/0627/09/11/20160627091121715.jpg','url' => 'http://tx.hls.huya.com/huyalive/29106097-2689286606-11550398022340837376-2789274544-10057-A-0-1.m3u8','id' => '1','type' => 'zj'],
  ['title' => '怪物科幻电影','img' => 'http://pic.baike.soso.com/p/20130618/20130618110448-672798252.jpg','url' => 'http://tx.hls.huya.com/huyalive/30765679-2478268764-10644083292078342144-2847699106-10057-A-0-1.m3u8','id' => '2','type' => 'zj'],
  ['title' => '赌博电影','img' => 'http://dl.pinyin.sogou.com/cache/skins/uploadImage/2015/02/13/14238213408463_former.jpg','url' => 'http://tx.hls.huya.com/huyalive/29106097-2689446042-11551082794746642432-2789253870-10057-A-0-1.m3u8','id' => '3','type' => 'zj'],
  ['title' => '古惑仔电影','img' => 'http://gb.cri.cn/mmsource/images/2014/07/11/eo140711002.jpg','url' => 'http://tx.hls.huya.com/huyalive/30765679-2523417522-10837995731143360512-2777068634-10057-A-0-1.m3u8','id' => '4','type' => 'zj'],
  ['title' => '王晶导演电影','img' => 'http://i.guancha.cn/news/2016/02/01/20160201161146553.jpg','url' => 'http://tx.hls.huya.com/huyalive/94525224-2579683592-11079656661667807232-2847687574-10057-A-0-1.m3u8','id' => '5','type' => 'mx'],
  ['title' => '徐克导演','img' => 'http://image14.m1905.cn/uploadfile/2016/0425/20160425074622526910_watermark.jpg','url' => 'http://tx.hls.huya.com/huyalive/29106097-2689447148-11551087544980471808-2789253872-10057-A-1525420294-1.m3u8','id' => '6','type' => 'mx'],
  ['title' => '吴京电影','img' => 'http://img1.i21st.cn/uploads/article/weixintt/79/14079/14079_34.jpg','url' => 'http://tx.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1.m3u8','id' => '7','type' => 'mx'],
  ['title' => '古天乐电影','img' => 'http://p0.qhimgs4.com/t01e520e4986d7d9319.jpg','url' => 'http://tx.hls.huya.com/huyalive/29169025-2686220040-11537227221659811840-2713685416-10057-A-1524041498-1.m3u8','id' => '8','type' => 'mx'],
  ['title' => '漫威电影','img' => 'http://p3.qhimg.com/t01231619d40331b633.jpg','url' => 'http://tx.hls.huya.com/huyalive/30765679-2504742278-10757786168918540288-3049003128-10057-A-0-1.m3u8','id' => '9','type' => 'zj'],
  ['title' => '甄子丹电影','img' => 'https://b2.bmp.ovh/imgs/2019/10/99fae5073b7edf5f.jpeg','url' => 'http://tx.hls.huya.com/huyalive/29169025-2686219938-11537226783573147648-2847699096-10057-A-1524024759-1.m3u8','id' => '10','type' => 'mx'],
  ['title' => '林正英电影','img' => 'https://b2.bmp.ovh/imgs/2019/10/fba6d4f495abd020.jpeg','url' => 'http://tx.hls.huya.com/huyalive/94525224-2460686034-10568566041753944064-2789274542-10057-A-0-1.m3u8','id' => '11','type' => 'mx'],
  ['title' => '洪金宝电影','img' => 'https://b2.bmp.ovh/imgs/2019/10/3e111ce1181f6952.jpeg','url' => 'http://tx.hls.huya.com/huyalive/29106097-2689406282-11550912026846953472-2789274558-10057-A-0-1.m3u8','id' => '12','type' => 'mx'],
  ['title' => '李连杰电影','img' => 'https://b2.bmp.ovh/imgs/2019/10/7881bd8be2bdad36.jpeg','url' => 'http://tx.hls.huya.com/huyalive/94525224-2460686093-10568566295157014528-2789253848-10057-A-0-1.m3u8','id' => '13','type' => 'mx'],
  ['title' => '刘德华电影','img' => 'http://dingyue.nosdn.127.net/Rhn0H2lc=prc6kzmuAxuTrUs1Xkce9ZOwiciu4H5LBk7l1544122950369.jpg','url' => 'http://tx.hls.huya.com/huyalive/94525224-2467341872-10597152648291418112-2789274550-10057-A-0-1.m3u8','id' => '14','type' => 'mx'],
  ['title' => '周润发电影','img' => 'http://img.mp.itc.cn/upload/20161118/8d15ccc607424a6b84b1b4929fa65e06_th.jpg','url' => 'http://tx.hls.huya.com/huyalive/94525224-2460685774-10568564925062447104-2789253840-10057-A-0-1.m3u8','id' => '15','type' => 'mx'],
  ['title' => '周星驰电影','img' => 'http://p4.qhimg.com/t0156d6b7cf59b07ced.jpg','url' => 'http://tx.hls.huya.com/huyalive/94525224-2460685313-10568562945082523648-2789274524-10057-A-0-1.m3u8','id' => '16','type' => 'mx'],
  ['title' => '成龙电影','img' => 'http://image.xinmin.cn/2016/09/02/b8ac6f402aaf19330b9d0c.jpg','url' => 'http://tx.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1.m3u8','id' => '19','type' => 'mx'],
  ['title' => '战争电影','img' => 'http://img3.yxlady.com/yl/UploadFiles_5361/20150923/20150923131437681.jpg','url' => 'http://tx.hls.huya.com/huyalive/28466698-2689659358-11551998979990355968-2789274580-10057-A-0-1.m3u8','id' => '34','type' => 'zj'],
  ['title' => '犯罪悬疑','img' => 'http://img1.gtimg.com/fj/pics/hv1/123/112/2293/149131008.jpg','url' => 'http://tx.hls.huya.com/huyalive/30765679-2480288304-10652757150331305984-2789274538-10057-A-1511757260-1.m3u8','id' => '35','type' => 'zj'],
  ['title' => '灾难电影','img' => 'http://img3.yxlady.com/yl/UploadFiles_5361/20150919/20150919231854486.jpg','url' => 'http://tx.hls.huya.com/huyalive/29359996-2689475864-11551210879261343744-2847699104-10057-A-1525430092-1.m3u8','id' => '36','type' => 'zj'],
  ['title' => '杰森.斯坦森','img' => 'http://n.sinaimg.cn/ent/transform/w630h429/20180214/Aw67-fyrpeie6077967.jpg','url' => 'http://tx.hls.huya.com/huyalive/29106097-2689279104-11550365801496182784-2777026902-10057-A-0-1.m3u8','id' => '37','type' => 'mx'],
  
  ['title' => 'CHC高清电影','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1521449765264&di=d34fdbee49173710e247b888dfaf799c&imgtype=0&src=http%3A%2F%2Fwww.5etime.com%2Finfo5%2Fuploads%2Fallimg%2F140204%2F6-1402040913150-L.jpg','url' => 'http://ivi.bupt.edu.cn/hls/chchd.m3u8','id' => '54','type' => 'tv'],
  ['title' => '东方卫视','img' => '/template/stui13/statics/tv/df.png','url' => 'http://ivi.bupt.edu.cn/hls/dfhd.m3u8','id' => '55','type' => 'ws'],
  ['title' => '云南卫视','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1521446996898&di=0c9e1f4fceb009660f8e13ab098f0e09&imgtype=jpg&src=http%3A%2F%2Fimg2.imgtn.bdimg.com%2Fit%2Fu%3D4167813717%2C485108299%26fm%3D214%26gp%3D0.jpg','url' => 'http://ivi.bupt.edu.cn/hls/yntv.m3u8','id' => '56','type' => 'ws'],
  ['title' => '内蒙古卫视','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1521448672137&di=a06d1b4333aa024205e38dca84d1aa95&imgtype=0&src=http%3A%2F%2Fwww.zhiboba.cc%2Fzbbimg%2Fneimengguweishi_zbb.jpg','url' => 'http://ivi.bupt.edu.cn/hls/nmtv.m3u8','id' => '57','type' => 'ws'],
  ['title' => '北京卡酷少儿','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b10000_10000&sec=1521431022&di=35b5372e3943f45dd98ac14cf1176bce&src=http://i6.qhimg.com/dr/250_500_/t01cce007620ff6c031.jpg','url' => 'http://ivi.bupt.edu.cn/hls/btv10.m3u8','id' => '59','type' => 'tv'],
  ['title' => '北京卫视','img' => '/template/stui13/statics/tv/bj.png','url' => 'http://ivi.bupt.edu.cn/hls/btv1hd.m3u8','id' => '60','type' => 'ws'],
  ['title' => '北京影视','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1521449195463&di=b81841e08a3583fe2fee9b5fdb8ec201&imgtype=0&src=http%3A%2F%2Fimgbdb3.bendibao.com%2Fbjbdb%2F201512%2F17%2F20151217211837_18180.jpg','url' => 'http://ivi.bupt.edu.cn/hls/btv4.m3u8','id' => '61','type' => 'ws'],
  ['title' => '北京文艺','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1521438875915&di=76b9adf8f628c6cfc98e958c22bd63b4&imgtype=0&src=http%3A%2F%2Fimgbdb3.bendibao.com%2Fbjbdb%2F201512%2F17%2F20151217211837_18180.jpg','url' => 'http://ivi.bupt.edu.cn/hls/btv2hd.m3u8','id' => '62','type' => 'ws'],
  ['title' => '厦门卫视','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1521440961685&di=56323ff2c8157013bcbd670c342cb87b&imgtype=0&src=http%3A%2F%2Fp2.img.cctvpic.com%2Fphotoworkspace%2Fcontentimg%2F2015%2F04%2F03%2F2015040317221992933.jpg','url' => 'http://ivi.bupt.edu.cn/hls/jstv.m3u8','id' => '63','type' => 'ws'],
  ['title' => '四川卫视','img' => '/template/stui13/statics/tv/sc.png','url' => 'http://ivi.bupt.edu.cn/hls/sctv.m3u8','id' => '64','type' => 'ws'],
  ['title' => '天津卫视','img' => '/template/stui13/statics/tv/tj.png','url' => 'http://ivi.bupt.edu.cn/hls/tjhd.m3u8','id' => '65','type' => 'ws'],
  ['title' => '宁夏卫视','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1521447468222&di=5734aae221d04e164c1949c8155fa489&imgtype=0&src=http%3A%2F%2Fg.hiphotos.baidu.com%2Fzhidao%2Fpic%2Fitem%2Fd01373f082025aaf4a28b028fcedab64034f1a3f.jpg','url' => 'http://ivi.bupt.edu.cn/hls/nxtv.m3u8','id' => '66','type' => 'ws'],
  ['title' => '安徽卫视','img' => '/template/stui13/statics/tv/ah.png','url' => 'http://ivi.bupt.edu.cn/hls/ahhd.m3u8','id' => '67','type' => 'ws'],
  ['title' => '山东卫视','img' => '/template/stui13/statics/tv/sd.png','url' => 'http://ivi.bupt.edu.cn/hls/sdhd.m3u8','id' => '68','type' => 'ws'],
  ['title' => '山西卫视','img' => '/template/stui13/statics/tv/sx1.png','url' => 'http://ivi.bupt.edu.cn/hls/sxrtv.m3u8','id' => '69','type' => 'ws'],
  ['title' => '广东卫视','img' => '/template/stui13/statics/tv/gd.png','url' => 'http://ivi.bupt.edu.cn/hls/gdhd.m3u8','id' => '70','type' => 'ws'],
  ['title' => '广西卫视','img' => '/template/stui13/statics/tv/gx.png','url' => 'http://ivi.bupt.edu.cn/hls/gxtv.m3u8','id' => '71','type' => 'ws'],
  ['title' => '江苏卫视','img' => '/template/stui13/statics/tv/js.png','url' => 'http://ivi.bupt.edu.cn/hls/jshd.m3u8','id' => '72','type' => 'ws'],
  ['title' => '江西卫视','img' => '/template/stui13/statics/tv/jx.png','url' => 'http://ivi.bupt.edu.cn/hls/jxtv.m3u8','id' => '73','type' => 'ws'],
  ['title' => '河北卫视','img' => '/template/stui13/statics/tv/heb.png','url' => 'http://ivi.bupt.edu.cn/hls/hebtv.m3u8','id' => '74','type' => 'ws'],
  ['title' => '河南卫视','img' => '/template/stui13/statics/tv/ha.png','url' => 'http://ivi.bupt.edu.cn/hls/hntv.m3u8','id' => '75','type' => 'ws'],
  ['title' => '浙江卫视','img' => '/template/stui13/statics/tv/zj.png','url' => 'http://ivi.bupt.edu.cn/hls/zjhd.m3u8','id' => '76','type' => 'ws'],
  ['title' => '深圳卫视','img' => '/template/stui13/statics/tv/sz.png','url' => 'http://ivi.bupt.edu.cn/hls/szhd.m3u8','id' => '77','type' => 'ws'],
  ['title' => '湖北卫视','img' => '/template/stui13/statics/tv/hub.png','url' => 'http://ivi.bupt.edu.cn/hls/hbhd.m3u8','id' => '78','type' => 'ws'],
  ['title' => '湖南卫视','img' => '/template/stui13/statics/tv/hn.png','url' => 'http://ivi.bupt.edu.cn/hls/hunanhd.m3u8','id' => '79','type' => 'ws'],
  ['title' => '甘肃卫视','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1521447579015&di=8a6c0bc5c0b82f09acbfe4aa18bd9839&imgtype=0&src=http%3A%2F%2Fwww.cctvmt.com%2Fmedia%2Fbig%2F41b61a89018d02b74cea19c16dfbfa1a.jpg','url' => 'http://ivi.bupt.edu.cn/hls/gstv.m3u8','id' => '80','type' => 'ws'],
  ['title' => '贵州卫视','img' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1521447335101&di=ef7aaedeeba668817393768219d57940&imgtype=0&src=http%3A%2F%2Fxianzhi.net%2Fuploads%2F140728%2F1-140HQ43916194.jpg','url' => 'http://ivi.bupt.edu.cn/hls/gztv.m3u8','id' => '83','type' => 'ws'],
  ['title' => '辽宁卫视','img' => '/template/stui13/statics/tv/ln.png','url' => 'http://ivi.bupt.edu.cn/hls/lnhd.m3u8','id' => '84','type' => 'ws'],
  ['title' => '重庆卫视','img' => '/template/stui13/statics/tv/cq.png','url' => 'http://ivi.bupt.edu.cn/hls/cqhd.m3u8','id' => '85','type' => 'ws'],
  ['title' => '陕西卫视','img' => '/template/stui13/statics/tv/sx2.png','url' => 'http://ivi.bupt.edu.cn/hls/sxtv.m3u8','id' => '86','type' => 'ws'],
  ['title' => '青海卫视','img' => 'http://img.shiting5.com/allimg/150119/6-150119212913J7.jpg','url' => 'http://ivi.bupt.edu.cn/hls/gxtv.m3u8','id' => '87','type' => 'ws'],
  ['title' => '黑龙江卫视','img' =>'/template/stui13/statics/tv/hlj.png','url' => 'http://ivi.bupt.edu.cn/hls/hljhd.m3u8','id' => '89','type' => 'ws'],
  ['title' => '电影解说','img' => '/template/stui13/statics/tv/dyjs.jpg','url' => 'https://tx.hls.huya.com/huyalive/94525224-2583571962-11096357083652554752-3503038830-10057-A-0-1.m3u8','id' => '501','type' => 'zj'],
  ['title' => '陈翔六点半','img' => 'http://n.sinaimg.cn/sinacn/w642h362/20180116/60e4-fyqrewi5335589.jpg','url' => 'https://tx.hls.huya.com/huyalive/94525224-2655537474-11405446604132450304-2704233350-10057-A-0-1.m3u8','id' => '502','type' => 'zj'],
  ['title' => '赵本山小品','img' => 'http://vpic.video.qq.com/6254906/c0354icom5n_ori_3.jpg','url' => 'https://aldirect.hls.huya.com/huyalive/29106097-2689443426-11551071559112196096-2789253866-10057-A-0-1_1200.m3u8','id' => '503','type' => 'zj'],
  ['title' => '开心鬼电影','img' => '/template/stui13/statics/tv/kxg.jpg','url' => 'https://aldirect.hls.huya.com/huyalive/29169025-2686221566-11537233775779905536-2789253842-10057-A-1523933708-1_1200.m3u8','id' => '504','type' => 'zj'],
  ['title' => '经典港片','img' => 'http://p.ssl.qhimg.com/t01a60c1ddb5a1e3181.jpg','url' => 'https://aldirect.hls.huya.com/huyalive/94525224-2472147404-10617792251071299584-2777026638-10057-A-0-1_1200.m3u8','id' => '505','type' => 'zj'],
  ['title' => '动画电影','img' => 'http://pic2.52pk.com/files/150921/3089546_092635_6577.jpg','url' => 'https://tx.hls.huya.com/huyalive/28466698-2689661530-11552008308659322880-3049003102-10057-A-0-1.m3u8','id' => '506','type' => 'zj']
],
];
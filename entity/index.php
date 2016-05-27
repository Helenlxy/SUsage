<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Zhixin StudentUnion OA System #Codename"SUsage" -->
<!-- ©2016 @Zhxsupc | https://github.com/zhxsuwebgroup/SUsage-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--引入wangEditor.css等样式表-->
<link rel="stylesheet" href="../res/css/themes/NWB-teal.css" />
<link rel="stylesheet" href="../res/css/md/material.css" />
<link rel="stylesheet" href="../res/css/editor/chkstyle.css" />
<link rel="stylesheet" href="../res/css/modules/ex-index.css" />
<link rel="stylesheet" href="../res/css/editor/wangEditor.css">
<link rel="stylesheet" href="../res/css/modules/ex-united.css" />
<!--网站标题以及icon-->
<title>你的任务 / SUsage Tasklist </title>
<link rel="shortcut icon" href="../res/icons/title/task_128X128.ico"/>

</head>

<body style="position:absolute;width:80%;">

<!--导航栏从此开始 -->
<div class="ex-navbar-for-Desktop">
<span class="mui-badge mui-badge-red" id="noti" style="display:none;left:500px" title="你收到了新通知"><b>!</b></span>
	<!--用户标签-->
	<a onclick="exit(); return false"><div class="ex-dnavbar-userbox" title="戳一下就退出哦w">
  <div class="ex-dnavbar-userbox-avatarfixbox">
  <img src="<?php echo $_SESSION['headimg']; ?>" style="height:54px;width:54px;" />
  </div>

  <div class="ex-dnavbar-userbox-usernamefixbox">
  <p class="ex-dnacvar-userbox-username"><?php echo $_SESSION['nickname']; ?></p>
  </div>

  <div class="ex-dnavbar-userbox-descunderunfixbox">
  <p class="ex-dnavbar-userbox-descunderunfb">点此退出</p></div>
</div></a>


	<!--第一个appbox-->
	<div id="ex-dnavbar-appbox1" class="ex-dnavbar-appbox-selected" >
<div class="ex-dnavbar-appbox-fixbox"><img src="../res/icons/bar/ic_task.png" style="height:52px;width:52px;"/></div>
<div class="ex-dnavbar-appbox-text">主页</div>
</div>
	<!--第二个appbox-->
    <a href="chat.php"><div id="ex-dnavbar-appbox2" class="ex-dnavbar-appbox" title="朝发白帝，暮到江陵">
    <div class="ex-dnavbar-appbox-fixbox"><img src="../res/icons/bar/ic_chat.png" style="height:52px;width:52px;" /></div>
    <div class="ex-dnavbar-appbox-text">聊天</div>
    </div></a>
	<!--返回顶部-->
	<a onclick="backtop(); return false" href="#"><div id="ex-dnavbar-appbox3" class="ex-dnavbar-appbox" title="咻咻~">
<div class="ex-dnavbar-appbox-fixbox"><img src="../res/icons/bar/ic_backtop.png" style="height:52px;width:52px;" /></div>
<div class="ex-dnavbar-appbox-text">返回顶部</div>
</div></a>
	</div>
<!--导航栏结束 -->

<!--退出提示-->
<div class="toast" id="toast-exit" style="background-color:#FFA000;position:fixed;width:100%;height:75px;z-index:100;display:none;">
	<label class="toast-label" style="font-family:微软雅黑;color:#ffffff;position:absolute;left:10%;line-height:55px;">你你你你你你你~真的要退出吗w</label>
	<button class="btn flat" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:60px;font-size:16px" onclick="window.location.href='logout.php'">是的</button>
    <button id="cancelexit" class="btn flat" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:60px;font-size:16px;font-weight:bold">不是</button>
</div>



<!-- 放在顶上的链接-->
<div id="about" class="ex-about" style="position:absolute;top:90px;width:100%;text-align:center;z-index:1;"><a onclick="dl(); return false">组长模式</a> · <a onclick="xpy(); return false">组员模式</a> · <a onclick="displaynote(); return false">测试通知</a> · <a href="https://github.com/zhxsuwebgroup/SUsage/wiki/%E5%B8%AE%E5%8A%A9%E4%B8%8E%E5%8F%8D%E9%A6%88%E4%B8%AD%E5%BF%83-%7C-Hints-&-Feedbacks" target="_blank" style="color:#00C853">帮助与反馈中心 </a>·<a href="http://zhxsuwebgroup.github.io/SUsage/" target="_blank" style="color:#00C853"> 关于 | 开源许可及协议声明 </a> <span style="color:#FFFFFF" title="用鼠标刮这里看看">试试alt+shift+g</span>  ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#9e9e9e">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#9e9e9e">电脑部</a> · In tech we trust
<p style="position:relative;color:#FF0000;margin-top:5px;font-family:微软雅黑;font-size:14px;text-align:center">以防你在写任务的时候不小心刷新页面以致前功尽弃，本页面已禁用F5键【千万别以为键盘坏了x——夏酱</p></div>
<!-- 发布器以及任务界面 -->
	<div id="poster" class="card rich-card" z="3" style="position:absolute;display:block;top:160px;width:100%;height:500px;text-align:center;z-index:1;left:13%;right:13%;">
		<h3 style="font-family:微软雅黑;margin-top:5px;left:0px;font-size:16px;position:relative;margin-left:15px;line-height:20px">在这里发布任务( · ω · )</h3>
		<div id="edtcontainer">
		<textarea id="textarea1" style="position:inherit;border-radius:5px;height:390px;width:100%;padding:0px 0px 0px 0px;display:block" ></textarea>
		</div>
		<div id="treecontainer" style="display:none"><div class="treetips"><span style="color:#4fb4f7;font-weight:bold;font-size: 19px">请在右侧<br>勾选任务的接收组别</span></span><br><br><span style="color:#f00000">勾选请点击项目前的小框<br>当此组别被勾选后，<br>此组别下所有的成员将接收到该任务。</span></div>
		<div class="tarea">
		<ul id="treeDemo" class="ztree"></ul></div>
		</div>
    	<button class="btn raised" id="submitbutton1" onclick="fwd(); return false" style="color:#fff;background-color:#4CAF50">下一步</button>
    	<button class="btn raised" id="backwardbutton" onclick="bwd(); return false" style="color:#fff;background-color:#4CAF50;display:none">上一步</button>
    	<button class="btn raised" id="submitbutton2" style="color:#fff;background-color:#4CAF50;display:none">发布任务</button>
        
	</div>

		<p id="tips1" style="position:absolute;top:670px;left:58%;text-align:center;font-size:18px;font-family:Microsoft Yahei">● 你的任务</p>
		<div id="listarea">
		<div class="card rich-card tasklist" z=4>
<img class="headimg" src="../storage/avatar/avatar-5117.jpg">
<span class="name" >学姐<！--这里要用echo搞出名字--></span><span class="time">发布于<span>2016-04-09 15:00</span></span>
	<div class="contentarea">
		<p>发布器发布任务之后，用index页面底部的脚本来获取发布器发布的html代码并写入数据库，再从数据库读取html置入这个div里面。编辑器开发文档参见http://www.kancloud.cn/wangfupeng/wangeditor2/113967</p>
	</div>
	<div class="card-footer">
		<button class="del btn raised raised">删除此任务</button>
		<button class="btn raised mark">标记为完成！</button>
	</div>
</div>

<div class="card rich-card tasklist" z=4>
<img class="headimg" src="../storage/avatar/avatar-5117.jpg">
<span class="name" >学姐<！--这里要用echo搞出名字--></span><span class="time">发布于<span>2016-04-09 15:00</span></span>
	<div class="contentarea">
		<p>左下角的删除按钮，只有该任务的发布人才会显示</p>
	</div>
	<div class="card-footer">
		<button class="del btn raised">删除此任务</button>
		<button class="btn raised mark">标记为完成！</button>
	</div>
</div>

<div class="card rich-card tasklist" z=4>
<img class="headimg" src="../storage/avatar/avatar-5117.jpg">
<span class="name" >学姐<！--这里要用echo搞出名字--></span><span class="time">发布于<span>2016-04-09 15:00</span></span>
	<div class="contentarea">
		<p>发布时间的读取和头像什么的交给你啦~</p>
	</div>
	<div class="card-footer">
		<button class="del btn raised">删除此任务</button>
		<button class="btn raised mark">标记为完成！</button>
	</div>
</div>

<div class="card rich-card tasklist" z=4>
<img class="headimg" src="../storage/avatar/avatar-5117.jpg">
<span class="name" >学姐<！--这里要用echo搞出名字--></span><span class="time">发布于<span>2016-04-09 15:00</span></span>
	<div class="contentarea">
		<p>测试</p>
		<p>张：江主席，你觉得董先生连任好不好啊？
江：好啊。
张：中央也支持他吗？
江：对啊，当然啦。
张：那为什么这么早就提出了而又没有别的人选呢？
张：欧盟呢最近发表了一个报告说呢……呃……北京会透过一些渠道去影响、干预香港的法治，你对这个看法有什么回应呢？
江：没听到这个事。
张：是彭定康说的。
江：你不能……你们媒体千万要注意啊，不要“见着风是得雨”啊，接到这些消息，你媒体本身也要判断，明白这意思吧？ 假使一些完全无中生有的东西，你再帮他说一遍，你等于……你也有责任吧？
张：现在呢那么早呢你们就是说支持董先生呢，会不会给人一种感觉就是内定了、是钦点了董先生呢？
江：没有任何（内定、钦点）的意思。还是按照香港的……按照基本法、按照选举的法——去产生……
张：但是你们那么……
江：你一定要……刚才你问我啊，我可以回答你一句“无可奉告”，那么你们又不高兴，那怎么办？
张：那董先生……
江：我讲的意思不是我去钦点他当下一任。你问我不支...支持不支持，我说支持。我就明确跟你告诉这一点。
张：江主席……
江：你们啊，你们……我感觉你们新闻界还要学习一个，你们非常熟悉西方的这一套的理论。你们毕竟还 too young（太年轻），明白这意思吧。我告诉你们我是身经百战了，见得多了！西方的哪一个国家我没去过？媒体他们——你们要知道，美国的华莱士，那比你们不知道高到哪里去啦。啊，我跟他谈笑风生！所以说媒体啊，要，那还是要提高自己的知识水平！懂我这个——识得唔识得啊？（懂不懂啊？）
江：欸，我也给你们着急啊，真的。
江：你们真的……我以为……遍地……你们有一个好，全世界跑到什么地方，你们比其他的西方记者啊跑得还快。但是呢问来问去的问题啊，都 too simple（太肤浅），啊，sometimes naïve！（有时很幼稚）懂了吗？
张：江主席，你觉得……
江：识得唔识得啊？（懂不懂啊？）
（一片嘈杂声）
记者：但是能不能说一下为什么支持董建华呢？
江：我很抱歉，我今天是作为一个长者跟你们讲这个。我不是新闻工作者，但是我见得太多了，我……我有这个必要告诉你们一点，人生的经验。
江：……我刚才呢……我刚才我很想啊，就是我每一次碰到你们我就讲中国有一句话叫“闷声大发财”，我就什么话也不说。这是最好的！但是我想，我见到你们这样热情啊，一句话不说也不好。所以你刚才你一定要——在宣传上将来如果你们报道上有偏差，你们要负责。我没有说要钦定（董建华），没有任何这个意思。但是你问，你一定要觉得要问我，对董先生支持不支持。我们不支持他，他现在是当特首我们怎么能不支持特首？
记者：但是如果说连任呢？
江：对不对？
江：欸，连任也要按照香港的法律啊，对不对？要，要...要，要按照香港的...当然我们的决定权也是很重要的。香港特区...特别行政区是属于中国...人民共和的中央人民政府啊。啊！到那时候我们会表态的！
记者：但是呢……
江：明白这意思吧？
江：你们啊，不要想……喜欢……然后弄个大新闻，说现在已经钦定了，再把我批判一番。
记者：不是，但是那就是……
江：你们啊，naïve！
记者：但是呢就是……
保安人员：好了好了够了……
江：I'm angry！我跟你讲，你们这样子啊是不行的！
江：我今天算得罪了你们一下！</p>
	</div>
	<div class="card-footer">
		<button class="del btn raised">删除此任务</button>
		<button class="btn raised mark">标记为完成！</button>
	</div>
</div>
<div class="card rich-card tasklist" z=4>
<img class="headimg" src="../storage/avatar/avatar-5117.jpg">
<span class="name" >学姐<！--这里要用echo搞出名字--></span><span class="time">发布于<span>2016-04-09 15:00</span></span>
	<div class="contentarea">
		<p>这个engineering drawing呢，我们就有几年用鸭嘴的笔，旁边一个小盒子。最痛苦的，就是鸭嘴笔把这个水弄到里面，描图的时候一下子就⋯然后就用刀片刮，这个就是描图是最痛苦的，而且这个效率efficiency⋯[18]
我的这个经历就是到了上海，到了89年的年初的时候，我在想我估计是快要离休了，我想我应该去当教授。于是我就给朱物华校长、张钟俊院长，给他们写了一个报告。他们说欢迎你来，不过，他这个Apply for Professor，那你要去做一个报告。我就做了一个能源与发展趋势的主要的节能措施，这个报告经过好几百个教授一致通过。那么上海交大教授当了以后我就做第二个报告，就是微电子工业的发展。这两个报告做了以后不久，过后，1989年的5月31号北京就把我调到北京去了。现在这个报告做了快20年了，所以呢我就去年呢在我们交大的学报，我发表了两篇文章，就是呼应这个89年的报告的。特别是昨天晚上，他又把我这个第二篇报告，还有我这十几年包括在电子工业部、上海市所做的有关于信息产业化的文章，总共我听他们讲是27篇。我也没有什么别的东西送给你们，我们拿来以后我叫钱秘书啊，就把这两个学报，两个学报的英文本，因为他们这里洋文好的人多得很呐，英文本，还有前面出过两本书，再加上昨天晚上出的这本书，送给郭伟华同志，给你送过来，那么给你们作为一个纪念。
那么人呐就都不知道，自己就不可以预料。你一个人的命运啊，当然要靠自我奋斗，但是也要考虑到历史的行程，我绝对不知道，我作为一个上海市委书记怎么把我选到北京去了，所以邓小平同志跟我讲话，说“中央都决定啦，你来当总书记”，我说另请高明吧。我实在我也不是谦虚，我一个上海市委书记怎么到北京来了呢？但是呢，小平同志讲“大家已经研究决定了”，所以后来我就念了两首(注：应为两句诗，此处为江主席口误作首)诗，叫“苟利国家生死以，岂因祸福避趋之”，那么所以我就到了北京。
到了北京我干了这十几年我也没有什么别的，大概三件事：
一个，确立了社会主义市场经济；
第二个，把邓小平的理论列入了党章；
第三个，就是我们知道的“三个代表”。
如果说还有一点什么成绩就是军队一律不得经商！这个对军队的命运有很大的关系。因为我后来又干了一年零八个月，等于我在部队干了15年军委主席。还有九八年的抗洪也是很大的。但这些都是次要的，我主要的我就是三件事情，很惭愧，就做了一点微小的工作，谢谢大家。
这是我用过的啊！？老由啊，现在他们文印的图章里面绝对没有这枚图章，都不知道有这么一个东西。
这就是说明二院的档案工作做得太好了！
你们给我搞的这本东西啊……Excited</p>
	</div>
	<div class="card-footer">
		<button class="del btn raised">删除此任务</button>
		<button class="btn raised mark">标记为完成！</button>
	</div>
</div>
<div class="card rich-card tasklist" z=4>
<img class="headimg" src="../storage/avatar/avatar-5117.jpg">
<span class="name" >学姐<！--这里要用echo搞出名字--></span><span class="time">发布于<span>2016-04-09 15:00</span></span>
	<div class="contentarea">
		<p>Four score and seven years ago our fathers brought forth on this continent, a new nation, conceived in Liberty, and dedicated to the proposition that ALL MEN ARE CREATED EQUAL.
</p>
	</div>
	<div class="card-footer">
		<button class="del btn raised">删除此任务</button>
		<button class="btn raised mark">标记为完成！</button>
	</div>
</div>
<p class="ex-end" style="left:11%">——————没了哟~——————</p>
</div>
		



<!--脚本引用-->
<script src="../res/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="../res/js/wangEditor.js"></script>
<script src="../res/js/basic.js"></script>
	<!--wangeditor操作-->
    <script type="text/javascript">
    var editor = new wangEditor('textarea1');
	
    editor.create();
		
		var submitbtn = document.getElementById('submitbutton');
		if(!$("textarea1").val())
		{
			submitbtn.style.display = 'block';
		}
	else
		{
			submitbtn.style.display = 'none';
		}
$('#submitbutton').click(function () {
		        // 获取编辑器区域完整html代码
        var html = editor.$txt.html();
				});
	</script>    

<script src="../res/js/ztree.core.js"></script>
<script src="../res/js/ztree.excheck.js"></script>
<SCRIPT type="text/javascript">
		<!--
		var setting = {
			data: {
				simpleData: {
					enable: true
				}
			}
		};

		var zNodes =[
			{ id:1, pId:0, name:"主席团"},
			{ id:2, pId:0, name:"内务部"},
			{ id:3, pId:0, name:"公关部"},
			{ id:4, pId:0, name:"电脑部", nocheck:true},
			{ id:5, pId:4, name:"美工组"},
			{ id:6, pId:4, name:"网页组"},
			{ id:7, pId:4, name:"视频组"},
			{ id:8, pId:4, name:"flash组"},
			{ id:9, pId:4, name:"后台组"},
			{ id:10, pId:0, name:"广播站"},
			{ id:11, pId:0, name:"电视台", nocheck:true},
			{ id:12, pId:11, name:"DV组"},
			{ id:13, pId:11, name:"DC组"},
			{ id:14, pId:11, name:"主持组"},
			{ id:15, pId:0, name:"社联"},
			{ id:16, pId:0, name:"文娱部"},
			{ id:17, pId:0, name:"宣传部"},
			{ id:18, pId:0, name:"学术部"},
			{ id:19, pId:0, name:"体育部"}
		];
		
		var code;
		
		function setCheck() {
			var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
			py = $("#py").attr("checked")? "p":"",
			sy = $("#sy").attr("checked")? "s":"",
			pn = $("#pn").attr("checked")? "p":"",
			sn = $("#sn").attr("checked")? "s":"",
			type = { "Y":py + sy, "N":pn + sn};
			zTree.setting.check.chkboxType = type;
			showCode('setting.check.chkboxType = { "Y" : "' + type.Y + '", "N" : "' + type.N + '" };');
		}
		function showCode(str) {
			if (!code) code = $("#code");
			code.empty();
			code.append("<li>"+str+"</li>");
		}
		
		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
			setCheck();
			$("#py").bind("change", setCheck);
			$("#sy").bind("change", setCheck);
			$("#pn").bind("change", setCheck);
			$("#sn").bind("change", setCheck);
		});
		//-->
	</SCRIPT>
    <script>
function easteregg(){
 if(event.altKey  &&  event.shiftKey  &&  event.keyCode == 71){
  window.location.href = "../entity/about.html";
 }
}

function refresh()
{
	if(event.keyCode == 116){
		event.keyCode=0;
    event.returnValue=false;
	}
}
document.onkeydown = function(){easteregg();refresh();};
</script>
<script>
		var renwu = document.getElementById('tips1');
		var postmodule = document.getElementById('poster');
		var liebiao = document.getElementById('listarea');
		function xpy(){postmodule.style.display = 'none';renwu.style.top = '120px';liebiao.style.top = '180px'}
		function dl(){postmodule.style.display = '';renwu.style.top = '670px';liebiao.style.top = '730px'}
</script>

<script>
		var iptbox = document.getElementById('edtcontainer');
		var treebox = document.getElementById('treecontainer');
		var fwdbtn = document.getElementById('submitbutton1');
		var bwdbtn = document.getElementById('backwardbutton');
		var pstbtn = document.getElementById('submitbutton2');
		function bwd(){treebox.style.display = 'none';iptbox.style.display = '';bwdbtn.style.display = 'none';fwdbtn.style.display = '';pstbtn.style.display = 'none'}
		function fwd(){treebox.style.display = 'block';iptbox.style.display = 'none';bwdbtn.style.display = 'block';fwdbtn.style.display = 'none';pstbtn.style.display = 'block'}
</script>
</body>
</html>

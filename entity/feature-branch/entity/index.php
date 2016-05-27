<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Zhixin StudentUnion OA System #Codename"SUsage" -->
<!-- ©2016 @Zhxsupc | https://github.com/zhxsuwebgroup/SUsage-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--引入wangEditor.css等样式表-->
<link rel="stylesheet" href="../res/css/themes/NWB-teal.css" />
<link rel="stylesheet" href="../res/css/md/material.css" />
<link rel="stylesheet" type="text/css" href="../res/css/editor/wangEditor.css">
<!--网站标题以及icon-->
<title>你的任务 / SUsage Tasklist </title>
<link rel="shortcut icon" href="../res/icons/title/task_128X128.ico"/>
</head>

<body style="position:absolute;width:80%;">

<!--导航栏从此开始 -->
<div class="ex-navbar-for-Desktop">
<span class="mui-badge mui-badge-red" id="noti" style="display:none;left:500px" onclick="noteread(); return false" title="点一下可以清除通知哦">3</span>
	<!--用户标签-->
	<a onclick="exit(); return false"><div class="ex-dnavbar-userbox" title="戳一下就退出哦w">
  <div class="ex-dnavbar-userbox-avatarfixbox">
  <img src="<?php echo $_SESSION['headimg']; ?>" style="height:54px;width:54px;" />
  </div>

  <div class="ex-dnavbar-userbox-usernamefixbox">
  <p class="ex-dnacvar-userbox-username"><?php echo $_SESSION['tname']; ?></p>
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
<a href="..\entity\file.php"><!--Edit here (修改路径即可)--><div id="ex-dnavbar-appbox2" class="ex-dnavbar-appbox" title="文件存放地兼赛车场">
<div class="ex-dnavbar-appbox-fixbox"><img src="../res/icons/bar/ic_files.png" style="height:52px;width:52px;" /><!--Edit here (修改路径即可)--></div>
<div class="ex-dnavbar-appbox-text">文件库<!--Edit here (修改文字即可)--></div>
</div></a>
<!--第三个appbox-->
<a href="..\entity\mail.php"><div id="ex-dnavbar-appbox3" class="ex-dnavbar-appbox-selected"  >
<div class="ex-dnavbar-appbox-fixbox"><img src="../res/icons/bar/ic_mail.png" style="height:52px;width:52px;" /><!--Edit here (修改路径即可)--></div>
<div class="ex-dnavbar-appbox-text">站内信<!--Edit here (修改文字即可)--></div>
</div>

<!--第四个appbox-->
<a href="..\entity\persecution.php"><!--Edit here (修改路径即可)--><div id="ex-dnavbar-appbox4" class="ex-dnavbar-appbox" title="想被关小黑屋吗？那感觉一颗赛艇！">
<div class="ex-dnavbar-appbox-fixbox"><img src="../res/icons/bar/ic_persecution.png" style="height:52px;width:52px;" /><!--Edit here (修改路径即可)--></div>
<div class="ex-dnavbar-appbox-text">批斗大会<!--Edit here (修改文字即可)--></div>
</div></a>

<!--请保留返回顶部按钮-->


<!--返回顶部-->
<a onclick="backtop(); return false" href="#"><div id="ex-dnavbar-appbox5" class="ex-dnavbar-appbox" title="咻咻~">
<div class="ex-dnavbar-appbox-fixbox"><img src="../res/icons/bar/ic_backtop.png" style="height:52px;width:52px;" /><!--Edit here (修改路径即可)--></div>
<div class="ex-dnavbar-appbox-text">返回顶部</div>
</div></a>
</div>

<!--导航栏结束 -->

<!--退出提示-->
<div class="toast" id="toast-exit" style="background-color:#FFA000;position:fixed;width:100%;height:75px;z-index:100;display:none;">
	<label class="toast-label" style="font-family:微软雅黑;color:#ffffff;position:absolute;left:10%;line-height:55px;">你你你你你你你~真的要退出吗w</label>
	<button class="button flat" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:60px;font-size:16px">是的</button>
    <button id="cancelexit" class="button flat" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:60px;font-size:16px;font-weight:bold">不是</button>
</div>



<!-- 放在顶上的链接-->
<div id="about" class="ex-about" style="position:absolute;top:90px;width:100%;text-align:center;z-index:1;"><a onclick="dl(); return false">大佬模式</a> · <a onclick="xpy(); return false">小朋友模式</a> · <a onclick="displaynote(); return false">测试通知</a> · <a href="https://github.com/zhxsuwebgroup/SUsage/wiki/%E4%BD%BF%E7%94%A8%E6%89%8B%E5%86%8C-%7C-How-to-Use" target="_blank" style="color:#00C853">还不知道使用方法？</a>·<a href="http://zhxsuwebgroup.github.io/SUsage/" target="_blank" style="color:#00C853"> 关于 | 开源许可及协议声明 </a> <span style="color:#FFFFFF" title="用鼠标刮这里看看">试试alt+shift+g</span>  ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#9e9e9e">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#9e9e9e">电脑部</a> · In tech we trust
<p style="position:relative;color:#FF0000;margin-top:5px;font-family:微软雅黑;font-size:14px;text-align:center">一个温馨的提示：以防你在写任务的时候不小心刷新页面以致前功尽弃，本页面已禁用F5键 · 上传文件功能尚未开放——夏夏夏夏夏夏夏夏酱</p></div>
<!-- 发布器以及任务界面 -->
	<div id="poster" class="card rich-card" z="3" style="position:absolute;display:block;top:160px;width:100%;height:500px;text-align:center;z-index:1;left:13%;right:13%;">
		<h3 style="font-family:微软雅黑;margin-top:5px;left:0px;font-size:16px;position:relative;margin-left:15px;line-height:20px">在这里发布任务( · ω · )</h3>
		<textarea id="textarea1" style="position:inherit;border-radius:5px;height:390px;width:100%;padding:0px 0px 0px 0px" ></textarea>
    	<button class="button raised" id="submitbutton" style="color:#fff;background-color:#4CAF50">发布任务</button>
        
		<div class="card-footer" style="position:absolute;bottom:0px;left:8px;">
			<button class="button" style="font-family:'Microsoft Yahei';color:#2196f3" title="你发过的任务都在这里~">历史记录</button>
		</div>
	</div>

<div>
		<p id="tips1" style="position:absolute;top:700px;left:58%;text-align:center;font-size:18px;font-family:Microsoft Yahei">● 你的任务</p>
		<area id="tasklist"></area>
		<p class="ex-end">——————没了哟~——————</p>
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
		function xpy(){postmodule.style.display = 'none';renwu.style.top = '150px'}
		function dl(){postmodule.style.display = '';renwu.style.top = '700px'}
</script>
</body>
</html>
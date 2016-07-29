<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/CheckLogged.php");
include("../functions/NightShift.php");
?>


<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../res/css/themes/Sinterface.css" />
	<link rel="stylesheet" href="../res/css/modules/ex-filesys.css" />
	<link rel="stylesheet" href="../res/css/modules/ex-united.css" />
	<title>来不及解释了，快上车！ / SUsage FileTour</title>
	<link rel="shortcut icon" href="../res/icons/title/files_128X128.ico"/>
	</head>
	<body>
	<!--导航栏从此开始 -->
	<div class="ex-navbar-for-Desktop">
		<span class="mui-badge mui-badge-red" id="noti" style="display:none;left:250px" title="你收到了新通知"><b>New</b></span>
		<!--用户标签-->
		<a href="UCenter.php" class="ex-dnavbar-userbox-descunderunfb" title="进入个人中心">
		<div class="ex-dnavbar-userbox">
			<div class="ex-dnavbar-userbox-avatarfixbox">
				<img src="<?php echo $_SESSION['headimg']; ?>" style="height:54px;width:54px;" />
			</div>
			<div class="ex-dnavbar-userbox-usernamefixbox">
				<p class="ex-dnacvar-userbox-username">
					<?php 
						echo $_SESSION['nickname']." , ";
							if ($h<5) echo '该休息了';
							else if ($h<11) echo '早上好呀';
							else if ($h<13) echo '到中午了';
							else if ($h<18) echo '下午好嘛';
							else if ($h<23) echo '天黑了呢';
							else echo '该休息了';
					?>
				</p>
			</div>
			<div class="ex-dnavbar-userbox-descunderunfixbox">
				<a onclick="backtop(); return false" class="ex-dnavbar-userbox-descunderunfb" href="#">返回顶部 ▲ </a>&#12288;<a onclick="exit(); return false" class="ex-dnavbar-userbox-descunderunfb" title="戳一下就退出哦w">注销 ></a>
			</div>
		</div>
		</a>
		<div id="appfixbox">
		<a href="index.php">
		<div class="ex-dnavbar-appbox" title="接好任务啊~">
			<img src="../res/icons/bar/ic_task.png"/>
			<div class="ex-dnavbar-appbox-text">主页</div>
		</div>
		</a>
		<div class="ex-dnavbar-appbox appbox-selected" title="来不及了，快上车！">
			<img src="../res/icons/bar/ic_files.png"/>
			<div class="ex-dnavbar-appbox-text">文件</div>
		</div>
	 </div>
	</div>
	<!--导航栏结束 -->

	<!--退出提示-->
	<div class="toast" id="toast-exit" style="position:fixed;width:100%;height:69px;z-index:100;display:none;">
			<label class="toast-label" style="font-family:微软雅黑;color:#ffffff;position:absolute;left:10%;line-height:45px;">你你你你你你你~真的要退出吗w</label>
			<button class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:55px;font-size:16px;cursor:pointer;" onclick="window.location.href='logout.php'">是的</button>
			<button id="cancelexit" class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:55px;font-size:16px;font-weight:bold;cursor:pointer;">不是</button>
	</div>
	<div id="untip"><h2>(0 v 0)你急个啥子噻，晓不晓得这里还是Under Construction呐<br>————夏酱</h2></div>
	<div class="not-allowed">
	<div class="blured">
	<!--侧边菜单-->
	<div class="sidemenu" id="menu" style="position:fixed;z-index:0;padding:75px 0 0 0;width:20%">
		<span style="margin-left:15px;font-family:微软雅黑;color:#00C853">想找什么？试试猛击F3...</span>
		<ul class="menu">
			<li style="font-family:微软雅黑"><a href="#">文档</a></li>
			<li style="font-family:微软雅黑"><a href="#">图片</a></li>
			<li style="font-family:微软雅黑"><a href="#">影音</a></li>
			<li class="selected" style="font-family:微软雅黑"><a href="#">压缩包</a></li>
			<li style="font-family:微软雅黑"><a href="#">公告</a></li>
			<li style="font-family:微软雅黑;font-size:12px;text-align:center"><a onclick="displaynote(); return false">点此测试通知</a></li>
			<li style="font-family:微软雅黑;font-size:12px;text-align:center"><a href="ucenter.php#helper" target="_blank">帮助与反馈中心 </a></li>
			<li style="font-family:微软雅黑;font-size:12px;text-align:center"><a href="http://zhxsu.github.io/SUsage/" target="_blank"> 关于 | 开源许可及协议声明 </a></li>
			<p style="font-family:微软雅黑;font-size:12px;color:#9f9f9f;text-align:center">©2016 
				<a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#9f9f9f">执信学生会</a>
				<a href="http://weibo.com/zhxsupc" target="_blank" style="color:#9f9f9f">电脑部</a>
			</p>
			<p style="font-family:微软雅黑;font-size:12px;color:#9f9f9f;text-align:center">In tech we trust</p>
			<p style="font-family:微软雅黑;font-size:12px;color:green;text-align:center" id="ver"></p>
			</ul>
	</div>
		<form style="z-index:99999">
					<div id="list" style="position:absolute;left:22%;right:50px;top:75px;">
							<ul class="list" style="width:100%;">
									<p style="text-align:left;font-family:微软雅黑;padding:0 0 0 15px;font-size:16px">压缩包</p>
											<li class="divider"></li>

									 <li  class="filesitem"><a onclick="" title="点击下载文件" class="name">CBS 60MIN 和华莱士谈笑风生.rar</a><p class="poster">Uploaded by <span>电脑部 夏酱</span></p><p class="size">301MB</p><a onclick="" class="del">删除</a></li>
									 <li  class="filesitem"><a onclick="" title="点击下载文件" class="name">国机二院.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">怒斥香港记者.7z</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">膜法师进阶教程.zip</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">葛底斯堡演讲 纯正美式录音.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">天气晴朗.tar.gz</a><p class="poster">Uploaded by <span>电脑部 夏酱</span></p><p class="size">301MB</p><a onclick="" class="del">删除</a></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">压缩率不知道高到哪里去.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">喝Evian，不再naive.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">长者表情包.rar</a><p class="poster">Uploaded by <span>电脑部 名字长长长长长长长长长长长长长长长</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤.rar</a><p class="poster">Uploaded by <span>电脑部 夏酱</span></p><p class="size">301MB</p><a onclick="" class="del">删除</a></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">暴力膜不可取.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">一颗赛艇.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">支持不支持.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">董先生是不是要连任.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">吼啊.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">支持不支持.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">董先生是不是要连任.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
											<li  class="filesitem"><a onclick="" title="点击下载文件" class="name">吼啊.rar</a><p class="poster">Uploaded by <span>电脑部 谭天</span></p><p class="size">301MB</p></li>
							</ul>
					</div>
			</form>
	</div>
	</div>

<!--脚本引用-->
<script src="../res/js/jquery-2.2.1.min.js"></script>
<script src="../res/js/basic.js"></script>
<script src="../res/js/GetCodeVer.js"></script>
<script>
//关于我们的彩蛋   
function easteregg(){
  if(event.altKey  &&  event.shiftKey  &&  event.keyCode == 71){
	  window.location.href = "about.html";
  }
}
document.onkeydown = function(){easteregg();};
</script>

</body>
</html>
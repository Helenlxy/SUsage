<?php 
session_start();
require_once("../functions/to_sql.php");
$group=$_SESSION['group'];
$sql=mysqli_query($conn,"SELECT * FROM task_list WHERE regroup='{$group}'");
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--引入wangEditor.css等样式表-->
<?php $h=date('G');if ($h<6) echo '<link rel="stylesheet" href="../res/css/themes/night.css" />';else if ($h>22) echo '<link rel="stylesheet" href="../res/css/themes/night.css" />';else echo '<link rel="stylesheet" href="../res/css/themes/day.css" />';?>

<link rel="stylesheet" href="../res/css/md/material.css" />
<link rel="stylesheet" href="../res/css/editor/chkstyle.css" />
<?php
if ($_SESSION['SUmaster']==1){
  echo "<link rel='stylesheet' href='../res/css/modules/ex-index-master.css' />";
}
else{
  echo "<link rel='stylesheet' href='../res/css/modules/ex-index-normal.css' />";
}
?>
<link rel="stylesheet" href="../res/css/editor/wangEditor.css">
<link rel="stylesheet" href="../res/css/modules/ex-united.css" />
<!--网站标题以及icon-->
<title>你的任务 / SUsage Tasklist </title>
<link rel="shortcut icon" href="../res/icons/title/task_128X128.ico"/>
</head>

<body style="position:absolute;width:80%;">

<!--导航栏从此开始 -->
<div class="ex-navbar-for-Desktop">
  <span class="mui-badge mui-badge-red" id="noti" style="display:none;left:250px" title="你收到了新通知"><b>New</b></span>
  <!--用户标签-->
  <a href="ucenter.php" class="ex-dnavbar-userbox-descunderunfb" title="进入个人中心">
  <div class="ex-dnavbar-userbox">
    <div class="ex-dnavbar-userbox-avatarfixbox">
      <img src="<?php echo $_SESSION['headimg']; ?>" style="height:54px;width:54px;" />
    </div>
    <div class="ex-dnavbar-userbox-usernamefixbox">
      <p class="ex-dnacvar-userbox-username">
        <?php echo $_SESSION['nickname']; ?>
         , <?php $h=date('G');if ($h<5) echo '该休息了';else if ($h<11) echo '早上好呀';else if ($h<13) echo '到中午了';else if ($h<18) echo '下午好嘛';else echo '天黑了呢';?>
      </p>
    </div>
    <div class="ex-dnavbar-userbox-descunderunfixbox">
      <a onclick="exit(); return false" class="ex-dnavbar-userbox-descunderunfb" title="戳一下就退出哦w">注销 ></a>
    </div>
  </div>
  </a>
  <div id="appfixbox">
  <div class="ex-dnavbar-appbox appbox-selected">
  	<img src="../res/icons/bar/ic_task.png"/>
  	<div class="ex-dnavbar-appbox-text">主页</div>
  </div>
  <a href="chat.php">
  <div class="ex-dnavbar-appbox" title="朝发白帝，暮到江陵">
  	<img src="../res/icons/bar/ic_chat.png"/>
  	<div class="ex-dnavbar-appbox-text">聊天</div>
  </div>
  </a>
  <a onclick="backtop(); return false" href="#">
  <div class="ex-dnavbar-appbox" title="咻咻~">
  	<img src="../res/icons/bar/ic_backtop.png"/>
    <div class="ex-dnavbar-appbox-text">顶部</div>
  </div>
  </a>
	</div>
</div>
<!--导航栏结束 -->

<!--退出提示-->
<div class="toast" id="toast-exit" style="position:fixed;width:100%;height:69px;z-index:100;display:none;">
	<label class="toast-label" style="font-family:微软雅黑;color:#ffffff;position:absolute;left:10%;line-height:45px;">你你你你你你你~真的要退出吗w</label>
	<button class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:55px;font-size:16px;cursor:pointer;" onclick="window.location.href='logout.php'">是的</button>
    <button id="cancelexit" class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:55px;font-size:16px;font-weight:bold;cursor:pointer;">不是</button>
</div>



<!-- 放在顶上的链接-->
<div id="about" class="ex-about" style="position:absolute;top:90px;width:100%;text-align:center;z-index:1;"><a onclick="displaynote(); return false">测试通知</a> · <a href="ucenter.php#helper" target="_blank" style="color:#00C853">帮助与反馈中心 </a>·<a href="http://zhxsu.github.io/SUsage/" target="_blank" style="color:#00C853"> 关于 | 开源许可及协议声明 </a> <span class="trick" title="用鼠标刮这里看看">试试alt+shift+g</span>  ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#9e9e9e">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#9e9e9e">电脑部</a> · In tech we trust
<p style="position:relative;color:#FF0000;margin-top:5px;font-family:微软雅黑;font-size:14px;text-align:center">以防你在写任务的时候不小心刷新页面以致前功尽弃，本页面已禁用F5键【千万别以为键盘坏了x——夏酱</p></div>

<!-- 发布器以及任务界面 -->

<div id='poster' class='card rich-card' z='3'>
		<h3 style='font-family:微软雅黑;margin-top:5px;left:0px;font-size:16px;position:relative;margin-left:15px;line-height:20px'>在这里发布任务( · ω · )</h3>
		<div id='edtcontainer'>
		<textarea id='textarea1' style='position:inherit;border-radius:5px;height:390px;width:100%;padding:0px 0px 0px 0px;display:block' ></textarea>
		</div>
		<div id='treecontainer' style='display:none'><div class='treetips'><span style='color:#4fb4f7;font-weight:bold;font-size: 19px'>请在右侧<br>勾选任务的接收组别</span></span><br><br><span style='color:#f00000'>勾选请点击项目前的小框<br>当此组别被勾选后，<br>此组别下所有的成员将接收到该任务。</span></div>
		<div class='tarea'>
		<ul id='treeDemo' class='ztree'></ul></div>
		</div>
    	<button class='btn raised green' id='submitbutton1' onclick='fwd(); return false'>下一步</button>
    	<button class='btn raised green' id='backwardbutton' onclick='bwd(); return false' style='display:none'>上一步</button>
    	<button class='btn raised green' id='submitbutton2' style='display:none' onclick='PostTask();'>发布任务</button>
        
	</div>
		<p id="tips1">● 你的任务</p>
		<div id="listarea">
		
<?php 
while($rs=mysqli_fetch_array($sql)){
$name=$rs['pubman'];
$pubgroup=$rs['pubgroup'];
$info=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM sys_user WHERE tname='$name'"));
$headimg=$info['headimg'];
?>		
<div class="card rich-card tasklist" z=4>
<img class="headimg" src="<?php echo $headimg; ?>">
<span class="name" ><?php echo $name; ?></span><span class="pubgroup" ><?php echo $pubgroup; ?></span><span class="time">发布于<span><?php echo $rs['pubtime']; ?></span></span>
	<div class="contentarea">
		<p><?php echo $rs['content']; ?></p>
	</div>
	<div class="card-footer">
	<?php
		$tname=$_SESSION['SUname'];
		if ($name==$tname) {
			echo "<button class='del btn raised raised red'>删除此任务</button>";
			echo "<a class='finishsum' href=''><span class='sumsty'>0</span>人完成了你的任务</a>";
		}
		else{
			echo "<button class='btn raised mark blue'>标记为完成！</button>";
		}

	?>
		
	</div>
</div>
<?php
}?>	

<center class="ex-end" style="left:12%">——————再怎么找都没有啦~——————</center>
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
				
function PostTask(){
  var html = editor.$txt.html();
  alert(html);
}

</script>    

<script src="../res/js/ztree.core.js"></script>
<script src="../res/js/ztree.excheck.js"></script>

<script>
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
			{ id:6, pId:4, name:"APP组"},
			{ id:7, pId:4, name:"视频组"},
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
		
		
		
//关于我们的彩蛋	
function easteregg(){
 if(event.altKey  &&  event.shiftKey  &&  event.keyCode == 71){
  window.location.href = "about.html";
 }
}

//禁止刷新
function lockf5()
{
  if(event.keyCode == 116){
    event.keyCode=0;
    event.returnValue=false;
	}
}

document.onkeydown = function(){easteregg();lockf5();};

		

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

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

<link rel="stylesheet" href="../res/css/themes/Sinterface.css" />
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
         , <?php $h=date('G');if ($h<5) echo '该休息了';else if ($h<11) echo '早上好呀';else if ($h<13) echo '到中午了';else if ($h<18) echo '下午好嘛';else if ($h<23) echo '天黑了呢';else echo '该休息了';?>
      </p>
    </div>
    <div class="ex-dnavbar-userbox-descunderunfixbox">
      <a onclick="backtop(); return false" class="ex-dnavbar-userbox-descunderunfb" href="#">返回顶部 ▲ </a>&#12288;<a onclick="exit(); return false" class="ex-dnavbar-userbox-descunderunfb" title="戳一下就退出哦w">注销 ></a>
    </div>
  </div>
  </a>
  
  <div id="appfixbox">
  <div class="ex-dnavbar-appbox appbox-selected">
    <img src="../res/icons/bar/ic_task.png"/>
    <div class="ex-dnavbar-appbox-text">主页</div>
  </div>
  <a href="file.php">
  <div class="ex-dnavbar-appbox" title="来不及了，快上车！">
    <img src="../res/icons/bar/ic_files.png"/>
    <div class="ex-dnavbar-appbox-text">文件</div>
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
<div id="about" class="ex-about" style="position:absolute;top:90px;width:100%;text-align:center;z-index:1;"><a onclick="displaynote(); return false">测试通知</a> · <a href="ucenter.php#helper" target="_blank" style="color:#00C853">帮助与反馈中心 </a>·<a href="http://zhxsu.github.io/SUsage/" target="_blank" style="color:#00C853"> 关于 | 开源许可及协议声明 </a> <span class="trick" title="用鼠标刮这里看看">试试alt+shift+g</span> SUsage 版本1D63 ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#9e9e9e">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#9e9e9e">电脑部</a> · In tech we trust
</div>

<!-- 发布器以及任务界面 -->

<div id='poster' class='card rich-card'>
		<h3 style='font-family:微软雅黑;margin-top:5px;left:0px;font-size:16px;position:relative;margin-left:15px;line-height:20px'>发布任务( · ω · )<span style="position:relative;color:#FF0000;margin-top:5px;font-family:微软雅黑;font-size:12px;text-align:center">&#12288;本页面已禁用F5键以防止误触导致草稿丢失【千万别以为键盘坏了x——夏酱</span></h3>
		<div id='edtcontainer'>
		<textarea id='textarea1' style='position:inherit;border-radius:5px;height:390px;width:100%;padding:0px 0px 0px 0px;display:block' onkeyup="CheckValue()"></textarea>
		</div>
		<div id='treecontainer' style='display:none'><div style="z-index:999999">
								<center style="line-height:10px;font-size: 13px">请在下方的复选框勾选任务的接收组别。当此组别被勾选后，此组别下所有的成员将接收到该任务。</center>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
                                    <input type="checkbox" id="checkNWB" />
                                    <label for="checkNWB" style="display:inline-block"></label>
                                    <span class="lablink">内务部</span>
                                </div>
                                <div class="checkbox" style="margin:15px 5% 0 5%;display:inline-block">
                                    <input type="checkbox" id="checkGGB"/>
                                    <label for="checkGGB" style="display:inline-block"></label>
                                    <span class="lablink">公关部</span>
                                </div>
                    			
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
                                    <input type="checkbox" id="checkGBZ" />
                                    <label for="checkGBZ" style="display:inline-block"></label>
                                    <span class="lablink">广播站</span>
                                </div>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
                                    <input type="checkbox" id="checkAU"/>
                                    <label for="checkAU" style="display:inline-block"></label>
                                    <span class="lablink">社&#12288;联</span>
                                </div>
                                <div class="checkbox" style="margin:15px 5% 0 5%;display:inline-block;">
                                    <input type="checkbox" id="checkWYB" />
                                    <label for="checkWYB" style="display:inline-block"></label>
                                    <span class="lablink">文娱部</span>
                                </div>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
                                    <input type="checkbox" id="checkXCB"/>
                                    <label for="checkXCB" style="display:inline-block"></label>
                                    <span class="lablink">宣传部</span>
                                </div>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block;">
                                    <input type="checkbox" id="checkXSB" />
                                    <label for="checkXSB" style="display:inline-block"></label>
                                    <span class="lablink">学术部</span>
                                </div>
                                <div class="checkbox" style="margin:15px 5% 0 5%;display:inline-block">
                                    <input type="checkbox" id="checkTYB"/>
                                    <label for="checkTYB" style="display:inline-block"></label>
                                    <span class="lablink">体育部</span>
                                </div>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
                                    <input type="checkbox" id="checkZXT"/>
                                    <label for="checkZXT" style="display:inline-block"></label>
                                    <span class="lablink">主席团</span>
                                </div>
                            <div>
                				<h3 class="fi-subtitle">—————— 电脑部 ——————</h3>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block;">
                                    <input type="checkbox" id="checkAPP" />
                                    <label for="checkAPP" style="display:inline-block"></label>
                                    <span class="lablink">APP组</span>
                                </div>
                                <div class="checkbox" style="margin:15px 5% 0 5%;display:inline-block">
                                    <input type="checkbox" id="checkHTZ"/>
                                    <label for="checkHTZ" style="display:inline-block"></label>
                                    <span class="lablink">后台组</span>
                                </div>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block;">
                                    <input type="checkbox" id="checkMGZ" />
                                    <label for="checkMGZ" style="display:inline-block"></label>
                                    <span class="lablink">美工组</span>
                                </div>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
                                    <input type="checkbox" id="checkSPZ"/>
                                    <label for="checkSPZ" style="display:inline-block"></label>
                                    <span class="lablink">视频组</span>
                                </div>
                            </div>
                            <div>
                				<h3 class="fi-subtitle">—————— 电视台 ——————</h3>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block;">
                                    <input type="checkbox" id="checkDVZ" />
                                    <label for="checkDVZ" style="display:inline-block"></label>
                                    <span class="lablink">DV组</span>
                                </div>
                                <div class="checkbox" style="margin:15px 5% 0 5%;display:inline-block">
                                    <input type="checkbox" id="checkDCZ"/>
                                    <label for="checkDCZ" style="display:inline-block"></label>
                                    <span class="lablink">DC组</span>
                                </div>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block;">
                                    <input type="checkbox" id="checkZCZ" />
                                    <label for="checkZCZ" style="display:inline-block"></label>
                                    <span class="lablink">主持组</span>
                                </div>
                                <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
                                    <input type="checkbox" id="checkTVS"/>
                                    <label for="checkTVS" style="display:inline-block"></label>
                                    <span class="lablink">视频组</span>
                                </div>
                            </div>
                            </div>
</div>
    	<button class='btn raised green' id='submitbutton1' onclick='fwd(); return false'>下一步</button>
    	<button class='btn raised green' id='backwardbutton' onclick='bwd(); return false' style='display:none'>上一步</button>
    	<button class='btn raised green' id='submitbutton2' style='display:none' onclick='PostTask();'>发布任务</button>
        
	</div>
		<p id="tips1">———— 你的任务 ————</p>
		<div id="listarea">
		
<?php 
while($rs=mysqli_fetch_array($sql)){
$name=$rs['pubman'];
$pubgroup=$rs['pubgroup'];
$info=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM sys_user WHERE tname='$name'"));
$headimg=$info['headimg'];
?>		
<div class="card rich-card tasklist">
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
<script src="../res/js/wangEditor.js"></script>
<script src="../res/js/basic.js"></script>

<!--wangeditor操作--><!--这里需要修改有关判断编辑区是否为空的代码-->
<script type="text/javascript">
  var editor = new wangEditor('textarea1');	
  editor.create();

	var submitbtn = document.getElementById('submitbutton1');
	function CheckValue(){
		
		if(editor.$txt.html()=='<p><br></p>')
		{
			submitbtn.style.display = 'none';
		}
		else
		{
			submitbtn.style.display = 'block';
		}
	}
				
function PostTask(){
  var html = editor.$txt.html();
  alert(html);
}



//关于我们的彩蛋	
function easteregg(){
 if(event.altKey  &&  event.shiftKey  &&  event.keyCode == 71){
  window.location.href = "about.html";
 }
}


document.onkeydown = function(){easteregg();};

		

	var iptbox = document.getElementById('edtcontainer');
	var treebox = document.getElementById('treecontainer');
	var fwdbtn = document.getElementById('submitbutton1');
	var bwdbtn = document.getElementById('backwardbutton');
	var pstbtn = document.getElementById('submitbutton2');
	function bwd(){treebox.style.display = 'none';iptbox.style.display = '';bwdbtn.style.display = 'none';fwdbtn.style.display = '';pstbtn.style.display = 'none'}
	function fwd(){treebox.style.display = 'block';iptbox.style.display = 'none';bwdbtn.style.display = 'block';fwdbtn.style.display = 'none';pstbtn.style.display = 'block'}
</script>

 <!--大bug-->   
<?php if ($_SESSION['SUmaster']==1){
  echo "<script src='../res/js/lockkey.js' />";
}?>

</body>
</html>

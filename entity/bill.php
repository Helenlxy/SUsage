<?php 
session_start();
require_once("../functions/to_sql.php");

//Night Shift
$h=date('G');
if ($h<6) 
  echo '<link rel="stylesheet" href="../res/css/themes/night.css" />';
else if ($h>22) 
  echo '<link rel="stylesheet" href="../res/css/themes/night.css" />';
else 
  echo '<link rel="stylesheet" href="../res/css/themes/day.css" />';
?>

<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>账务公开 / SUsage BillList</title>
  <link rel="stylesheet" type="text/css" href="../res/css/modules/ex-ucenter.css">
  <link rel="stylesheet" href="../res/css/editor/cropper.min.css">
  <link rel="shortcut icon" href="../res/icons/title/login_128X128.ico"/>
  <link rel="stylesheet" href="../res/css/themes/Sinterface.css" />
  <link rel="stylesheet" href="../res/css/modules/ex-united.css" />
</head>
<body>

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
  <a href="index.php">
  <div class="ex-dnavbar-appbox" title="接好任务啊~">
    <img src="../res/icons/bar/ic_task.png"/>
    <div class="ex-dnavbar-appbox-text">主页</div>
  </div>
  </a>
  <a href="file.php">
  <div class="ex-dnavbar-appbox" title="来不及了，快上车！">
    <img src="../res/icons/bar/ic_files.png"/>
    <div class="ex-dnavbar-appbox-text">文件</div>
  </div>
  </a>
 </div>
</div>


<!--退出提示-->
<div class="toast" id="toast-exit" style="position:fixed;width:100%;height:69px;z-index:100;display:none;">
    <label class="toast-label" style="font-family:微软雅黑;color:#ffffff;position:absolute;left:10%;line-height:45px;">你你你你你你你~真的要退出吗w</label>
    <button class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:55px;font-size:16px;cursor:pointer;" onclick="window.location.href='logout.php'">是的</button>
    <button id="cancelexit" class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:55px;font-size:16px;font-weight:bold;cursor:pointer;">不是</button>
</div>
	<article class="htmleaf-content">
		<div class="subtitle"><h2 style="color:#4fb4f7">账务公开<span style="font-size: 14px"> / BillList</span></h2></div>
			<center style="margin-top:120px">喂！这里是里区，你怎么进来的……<br><s>反正你也没有权限，啥都看不到~</s></center>
	</article>
        
<script src="../res/js/basic.js"></script>
<script src="../res/js/lrz.all.bundle.js"></script>
<script src="../res/js/jquery-2.2.1.min.js"></script>
<script src="../res/js/cropper.min.js"></script>
<script src="../res/js/ucenter.js"></script>
<script>
function easteregg(){
  if(event.altKey  &&  event.shiftKey  &&  event.keyCode == 71){
    window.location.href = "about.html";
  }
}

document.onkeydown = function(){easteregg();};
</script>
	
</body>
</html>
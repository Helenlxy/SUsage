<?php
$url=$_SERVER['PHP_SELF']; 
$nowpg=explode("/",$url);
$nowpg=$nowpg[count($nowpg)-1];
$nowpg=substr($nowpg,0,strlen($nowpg)-4);
$h=date("G");
?>
		
<!-- [begin]导航栏 -->
<div class="ex-navbar-for-Desktop">
 <!-- 用户标签 -->
 <a href="UCenter.php" class="ex-dnavbar-userbox-descunderunfb" title="进入个人中心">
  <div class="ex-dnavbar-userbox">
   <div class="ex-dnavbar-userbox-avatarfixbox">
    <img id="hdimg" src="<?php echo $_SESSION['headimg']; ?>" style="height:54px;width:54px;opacity: 0"/>
   </div>
   <div class="ex-dnavbar-userbox-usernamefixbox">
    <p class="ex-dnacvar-userbox-username" id="namebox">
    <?php 
    echo $_SESSION['nickname']." , ";
    if($h<5) echo '该休息了';
    else if($h<11) echo '早上好呀';
    else if($h<13) echo '到中午了';
    else if($h<18) echo '下午好嘛';
    else if($h<22) echo '天黑了呢';
    else echo '该休息了';
    ?>
    </p>
   </div>
   <div class="ex-dnavbar-userbox-descunderunfixbox">
    <a onclick="backtop(); return false" class="ex-dnavbar-userbox-descunderunfb" id="bktp" href="#">返回顶部 ▲ </a>&#12288;<a onclick="exit(); return false" class="ex-dnavbar-userbox-descunderunfb" title="戳一下就退出哦w">注销 ></a>
   </div>
  </div>
 </a>
 <div id="appfixbox">
  <?php if($nowpg=="index"){ ?>
  <div class="ex-dnavbar-appbox appbox-selected">
  <img src="../res/icons/bar/ic_task.png"/>
  <div class="ex-dnavbar-appbox-text">主页</div>
  </div>
  <a href="bill.php">
   <div class="ex-dnavbar-appbox" title="闷声才能发大财">
    <img src="../res/icons/bar/ic_files.png"/>
    <div class="ex-dnavbar-appbox-text">账务</div>
   </div>
  </a>
  <?php }else if($nowpg=="bill"){ ?>
  <a href="index.php">
   <div class="ex-dnavbar-appbox" title="接好任务啊~">
    <img src="../res/icons/bar/ic_task.png"/>
    <div class="ex-dnavbar-appbox-text">主页</div>
   </div>
  </a>
  <div class="ex-dnavbar-appbox appbox-selected">
					<img src="../res/icons/bar/ic_files.png"/>
						<div class="ex-dnavbar-appbox-text">账务</div>
  </div>
  <?php }else{ ?>
  <a href="index.php">
   <div class="ex-dnavbar-appbox" title="接好任务啊~">
    <img src="../res/icons/bar/ic_task.png"/>
    <div class="ex-dnavbar-appbox-text">主页</div>
   </div>
  </a>
  <a href="bill.php">
   <div class="ex-dnavbar-appbox" title="闷声才能发大财">
    <img src="../res/icons/bar/ic_files.png"/>
    <div class="ex-dnavbar-appbox-text">账务</div>
   </div>
  </a>
  <?php } ?>
  </div>
 </div>
<!-- [end]导航栏结束 -->
<!-- [begin]退出提示 -->
<div class="toast" id="toast-exit" style="position:fixed;width:100%;height:69px;z-index:100;display:none;">
 <label class="toast-label" style="font-family:微软雅黑;color:#ffffff;position:absolute;left:10%;line-height:45px;">你你你你你你你~真的要退出吗w</label>
 <button class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:55px;font-size:16px;cursor:pointer;" onclick="window.location.href='logout.php'">是的</button>
 <button id="cancelexit" class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:55px;font-size:16px;font-weight:bold;cursor:pointer;">不是</button>
</div>
<!-- [end]退出提示 -->
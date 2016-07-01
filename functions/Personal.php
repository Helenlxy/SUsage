<div class="ex-navbar-for-Desktop">
  <span class="mui-badge mui-badge-red" id="noti" style="display:none;left:250px" title="你收到了新通知"><b>New</b></span>
  <!--用户标签-->
  <div class="ex-dnavbar-userbox">
    <div class="ex-dnavbar-userbox-avatarfixbox">
      <img src="<?php echo $_SESSION['headimg']; ?>" style="height:54px;width:54px;" />
    </div>
    <div class="ex-dnavbar-userbox-usernamefixbox">
      <p class="ex-dnacvar-userbox-username">
        <?php echo $_SESSION['nickname']; ?>
         , <?php $h=date('G');if ($h<11) echo '早上';else if ($h<13) echo '中午';else if ($h<17) echo '下午';else echo '晚上';?>好呀
      </p>
    </div>
    <div class="ex-dnavbar-userbox-descunderunfixbox">
      <a href="ucenter.php" class="ex-dnavbar-userbox-descunderunfb" title="进入个人中心">个人中心 ></a><span>&#12288;</span><a onclick="exit(); return false" class="ex-dnavbar-userbox-descunderunfb" title="戳一下就退出哦w">注销 ></a>
    </div>
  </div>
  <a href="index.php">
  <div id="appfixbox">
  <div class="ex-dnavbar-appbox">
    <img src="../res/icons/bar/ic_task.png"/>
    <div class="ex-dnavbar-appbox-text">主页</div>
  </div>
  </a>
  <div class="ex-dnavbar-appbox appbox-selected" title="朝发白帝，暮到江陵">
    <img src="../res/icons/bar/ic_chat.png"/>
    <div class="ex-dnavbar-appbox-text">聊天</div>
  </div>
  
  <a onclick="backtop(); return false" href="#">
  <div class="ex-dnavbar-appbox" title="咻咻~">
    <img src="../res/icons/bar/ic_backtop.png"/>
    <div class="ex-dnavbar-appbox-text">顶部</div>
  </div>
  </a>
  </div>
</div>


<!--退出提示-->
<div class="toast" id="toast-exit" style="background-color:#FFA000;position:fixed;width:100%;height:75px;z-index:100;display:none;">
  <label class="toast-label" style="font-family:微软雅黑;color:#ffffff;position:absolute;left:10%;line-height:55px;">你你你你你你你~真的要退出登录吗w</label>
  <button class="btn flat" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:60px;font-size:16px" onclick="window.location.href='logout.php'">是的</button>
    <button id="cancelexit" class="btn flat" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:60px;font-size:16px;font-weight:bold">不是</button>
</div>
<!--导航栏从此开始 -->
<div class="ex-navbar-for-Desktop">
<span class="mui-badge mui-badge-red" id="noti" style="display:none;left:500px" title="你收到了新通知">!</span>
	<!--用户标签-->
	<a href="ucenter.php"><div class="ex-dnavbar-userbox" title="进入个人中心">
  <div class="ex-dnavbar-userbox-avatarfixbox">
  <img src="<?php echo $_SESSION['headimg']; ?>" style="height:54px;width:54px;" />
  </div>

  <div class="ex-dnavbar-userbox-usernamefixbox">
  <p class="ex-dnacvar-userbox-username"><?php echo $_SESSION['nickname']; ?></p>
  </div>

  <div class="ex-dnavbar-userbox-descunderunfixbox">
  <a onclick="exit(); return false"class="ex-dnavbar-userbox-descunderunfb" title="戳一下就退出哦w">点此退出</a></div>
</div></a>
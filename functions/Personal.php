<!--导航栏从此开始 -->
<div class="ex-navbar-for-Desktop">
<span class="mui-badge mui-badge-red" id="noti" style="display:none;left:500px" onclick="noteread(); return false" title="点一下可以清除通知哦">3</span>
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
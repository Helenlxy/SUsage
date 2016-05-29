<?php 
session_start();
?>
<div class="ex-navbar-for-Desktop">
<span class="mui-badge mui-badge-red" id="noti" style="display:none;left:500px" onclick="noteread(); return false" title="点一下可以清除通知哦">3</span>

<!--用户标签-->
<a onclick="exit(); return false"><div class="ex-dnavbar-userbox" title="戳一下就退出哦w">

<div class="ex-dnavbar-userbox-avatarfixbox">
<img src="../storage/avatar/avatar_supc.jpg" style="height:54px;width:54px;" />
<!--Edit here 1 (修改路径即可)--></div>

<div class="ex-dnavbar-userbox-usernamefixbox">
<p class="ex-dnacvar-userbox-username"><?php echo $_SESSION['nickname']; ?></p></div>

<div class="ex-dnavbar-userbox-descunderunfixbox"><p class="ex-dnavbar-userbox-descunderunfb">点此退出</p></div>
</div></a>


<!--第一个appbox-->
<a href="../entity/index.php">
<div id="ex-dnavbar-appbox1" class="ex-dnavbar-appbox-selected" >
<div class="ex-dnavbar-appbox-fixbox">
<img src="../res/icons/bar/ic_task.png" style="height:52px;width:52px;"/>
</div>
<div class="ex-dnavbar-appbox-text">主页</div>
</div></a>

<!--第二个appbox-->
<a href="../entity/mail.php">
<div id="ex-dnavbar-appbox2" class="ex-dnavbar-appbox" title="朝发白帝，暮到江陵">
<div class="ex-dnavbar-appbox-fixbox">
<img src="../res/icons/bar/ic_mail.png" style="height:52px;width:52px;" />
</div>
<div class="ex-dnavbar-appbox-text">站内信</div>
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
	<button class="button flat" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:60px;font-size:16px">是的</button>
    <button id="cancelexit" class="button flat" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:60px;font-size:16px;font-weight:bold">不是</button>
</div>
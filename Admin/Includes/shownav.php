<style>.navbar-default .navbar-toggle {border-color:transparent;}
.navbar-default {border-color: transparent;}
@media (min-width: 768px)
.navbar {border-radius: 4px;}
body { padding-top: 70px; }
</style>
<nav class="navbar navbar-default navbar-fixed-top"> 
<div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span> 
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand">SUsage / 管理中心</a>
  </div>
  
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">    
   <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">用户管理<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="../User/toAdd.php?sutk=<?php echo $SUtoken; ?>">用户新增</a></li>
        <li><a href="../User/toList.php?sutk=<?php echo $SUtoken; ?>">用户资料修改</a></li>
        <?php if($_SESSION['isSuper']=="1"){ ?>
        <li><a href="../User/toResetList.php?sutk=<?php echo $SUtoken; ?>">用户重置密码</a></li>
        <?php } ?>
        <li class="divider"></li>
        <!--<li><a href="../Log/toList.php">操作记录</a></li>-->
        <li><a href="../Sys/toSetRoleList.php?sutk=<?php echo $SUtoken; ?>">用户角色配置</a></li>
      </ul>
    </li>
    <?php if($_SESSION['isSuper']!="1" || $_SESSION['isRoot']=="1"){ ?>
    <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">账务管理<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="../Bill/toBillList.php?sutk=<?php echo $SUtoken; ?>">账目管理</a></li>
        <li><a href="../Bill/toChgMoney.php?sutk=<?php echo $SUtoken; ?>">修改账目金额</a></li>
        <li class="divider"></li>
        <li><a href="../Bill/toSetSeePurvList.php?sutk=<?php echo $SUtoken; ?>">分配账目查看权限</a></li>
      </ul>
    </li>
    <?php } ?>
    <li><a href="../Task/toList.php?sutk=<?php echo $SUtoken; ?>">任务管理</a></li>
    <li><a href="../Task/toPubGlobalNotice.php?sutk=<?php echo $SUtoken; ?>">公告管理</a></li>  
  </ul>
  
  <ul class="nav navbar-nav navbar-right">
    <li style="padding-right: 20px"><center><b><font color="green"><?php echo $_SESSION["name"]; ?></font></b>，欢迎回来<p><span style="color:#4fb4f7"><?php echo $_SESSION["role"]; ?> · <a href="../logout.php?sutk=<?php echo $SUtoken; ?>">退出登陆</a></center></li>
  </ul>
</div>
</div>
</nav>

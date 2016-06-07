
<div class="navbar navbar-default">
<div class="container-fluid">
<div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="navbar-inverse-collapse">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" href="/SUsage/Admin/console.php?sutk=<?php echo $SUtoken; ?>">SUsage / 管理中心</a>
</div>
<div class="navbar-collapse collapse navbar-inverse-collapse">
  <ul class="nav navbar-nav">    
   <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">系统管理
      <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/SUsage/Admin/User/toList.php?sutk=<?php echo $SUtoken; ?>">用户管理</a></li>
        <li><a href="/SUsage/Admin/User/toResetList.php?sutk=<?php echo $SUtoken; ?>">用户重置密码</a></li>
        <li class="divider"></li>
        <!--<li><a href="/SUsage/Admin/Log/toList.php">操作记录</a></li>-->
        <li><a href="/SUsage/Admin/Sys/toRolePurview.php?sutk=<?php echo $SUtoken; ?>">查看角色权限</a></li>
        <li><a href="/SUsage/Admin/Sys/toSetRoleList.php?sutk=<?php echo $SUtoken; ?>">用户角色配置</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">任务管理
      <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/SUsage/Admin/Task/toList.php?sutk=<?php echo $SUtoken; ?>">管理所有任务</a></li>
        <li><a href="/SUsage/Admin/Task/toPubGlobalNotice.php?sutk=<?php echo $SUtoken; ?>">发布全局通知</a></li>
      </ul>
    </li>
    
  <!--
  <li class="dropdown">
    <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">聊天管理
    <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="/SUsage/Admin/Chat/toSetAutoDel.php">设置记录自动删除时间</a></li>
    </ul>
  </li>-->
  
  </ul>
  
  <ul class="nav navbar-nav navbar-right">
    <li><center><b><font color="green"><?php echo $_SESSION["name"]; ?></font></b>，欢迎回来</center><p><span style="color:#4fb4f7">角色：<?php echo $_SESSION["role"]; ?> · <a href="/SUsage/Admin/logout.php?sutk=<?php echo $SUtoken; ?>">退出登陆</a></li>
  </ul>
</div>
</div>
</div>
<link href="https://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

<nav class="navbar navbar-default navbar-fixed-top"> 
<div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span> 
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">SUsage / 管理中心</a>
  </div>
  
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">    
   <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users" aria-hidden="true"></i> 用户管理<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="../User/toList.php?sutk=<?php echo $SUtoken; ?>"><i class="fa fa-users" aria-hidden="true"></i> 用户列表/资料编辑</a></li>
        <li><a href="../User/toAdd.php?sutk=<?php echo $SUtoken; ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> 用户新增</a></li>
        <li class="divider"></li>
        <?php if(GetSess('isSuper')=="1"){ ?>
        <li><a href="../User/toResetList.php?sutk=<?php echo $SUtoken; ?>"><i class="fa fa-key" aria-hidden="true"></i> 用户重置密码</a></li>
        <?php } ?>
        <li><a href="../Sys/toSetRoleList.php?sutk=<?php echo $SUtoken; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> 用户角色配置</a></li>
        <?php if(GetSess('isRoot')=="1"){ ?>
        <li><a href="../User/toUnlockUserList.php?sutk=<?php echo $SUtoken; ?>"><i class="fa fa-unlock" aria-hidden="true"></i> 解锁用户</a></li>
        <?php } ?>
      </ul>
    </li>
    <?php if(GetSess('isSuper')!="1" || GetSess('isRoot')=="1"){ ?>
    <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-line-chart" aria-hidden="true"></i> 账务管理<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="../Bill/toAddBillList.php?sutk=<?php echo $SUtoken; ?>">录入新账单</a></li>
        <li><a href="../Bill/toBillList.php?sutk=<?php echo $SUtoken; ?>">账单管理</a></li>
        <li class="divider"></li>
        <li><a href="../Bill/toChgMoney.php?sutk=<?php echo $SUtoken; ?>">修改账目金额</a></li>
        <li class="divider"></li>
        <li><a href="../Bill/toSetSeePurvList.php?sutk=<?php echo $SUtoken; ?>">分配账目查看权限</a></li>
      </ul>
    </li>
    <?php } ?>
    <li><a href="../Task/toList.php?sutk=<?php echo $SUtoken; ?>"><i class="fa fa-tasks" aria-hidden="true"></i> 任务管理</a></li>
    <li><a href="../Task/toPubGlobalNotice.php?sutk=<?php echo $SUtoken; ?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i> 公告管理</a></li>
    <?php if(GetSess('isSuper')=="1" || GetSess('isRoot')=="1"){ ?>
    <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears" aria-hidden="true"></i> 系统管理<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="../Sys/toResetWFD.php?sutk=<?php echo $SUtoken; ?>" target="_blank"><i class="fa fa-refresh" aria-hidden="true"></i> 重置任务完成记录</a></li>
        <li><a href="../Sys/toMaintenanceWFD.php?sutk=<?php echo $SUtoken; ?>" target="_blank"><i class="fa fa-wrench" aria-hidden="true"></i> 修复WFD数据（除害/补漏）</a></li>
        <li class="divider"></li>
        <li><a href="../Sys/toLoginLogList.php?sutk=<?php echo $SUtoken; ?>"><i class="fa fa-list-alt" aria-hidden="true"></i> 查看用户登录记录</a></li>
        <li class="divider"></li>
        <li><a href="https://www.zhxsu.com/phpsql" target="_blank"><i class="fa fa-database" aria-hidden="true"></i> 数据库管理平台</a></li>
      </ul>
    </li>
    <?php } ?>
  </ul>
  
  <ul class="nav navbar-nav navbar-right">
    <li><center><b><font color="green"><?php echo $_SESSION["name"]; ?></font></b>，欢迎回来<p><span style="color:#4fb4f7;margin-right:8px">角色：<?php echo $_SESSION["role"]; ?> · <a href="../logout.php?sutk=<?php echo $SUtoken; ?>">退出登陆</a></center></li>
  </ul>
</div>
</div>
</nav>
<style>body { padding-top: 70px; }</style>
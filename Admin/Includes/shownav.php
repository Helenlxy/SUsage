<nav class="navbar navbar-default navbar-fixed-top"> 
<div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
    <span class="sr-only">Toggle navigation</span>
    <span> 菜单 </span>
    </button>
    <a class="navbar-brand" href="#">SUsage / 管理中心</a>
  </div>
  
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">    
   <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">用户管理<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="../User/toList.php?sutk=<?php echo $SUtoken; ?>">用户列表/资料编辑</a></li>
        <li><a href="../User/toAdd.php?sutk=<?php echo $SUtoken; ?>">用户新增</a></li>
        <li class="divider"></li>
        <?php if(GetSess('isSuper')=="1"){ ?>
        <li><a href="../User/toResetList.php?sutk=<?php echo $SUtoken; ?>">用户重置密码</a></li>
        <?php } ?>
        <li><a href="../Sys/toSetRoleList.php?sutk=<?php echo $SUtoken; ?>">用户角色配置</a></li>
        <?php if(GetSess('isRoot')=="1"){ ?>
        <li><a href="../User/toUnlockUserList.php?sutk=<?php echo $SUtoken; ?>">解锁用户</a></li>
        <?php } ?>
      </ul>
    </li>
    <?php if(GetSess('isSuper')!="1" || GetSess('isRoot')=="1"){ ?>
    <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">账务管理<b class="caret"></b></a>
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
    <li><a href="../Task/toList.php?sutk=<?php echo $SUtoken; ?>">任务管理</a></li>
    <li><a href="../Task/toPubGlobalNotice.php?sutk=<?php echo $SUtoken; ?>">公告管理</a></li>
    <?php if(GetSess('isSuper')=="1" || GetSess('isRoot')=="1"){ ?>
    <li class="dropdown">
      <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">系统管理<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="../Sys/toResetWFD.php?sutk=<?php echo $SUtoken; ?>" target="_blank">重置任务完成记录</a></li>
        <li><a href="../Sys/toMaintenanceWFD.php?sutk=<?php echo $SUtoken; ?>" target="_blank">修复WFD数据（除害/补漏）</a></li>
        <li class="divider"></li>
        <li><a href="../Sys/toLoginLogList.php?sutk=<?php echo $SUtoken; ?>">查看用户登录记录</a></li>
        <li class="divider"></li>
        <li><a href="#" target="_blank">数据库管理平台</a></li>
      </ul>
    </li>
    <?php } ?>
  </ul>
  
  <ul class="nav navbar-nav navbar-right">
    <li style="margin-top:5px"><center><b><font color="green"><?php echo $_SESSION["name"]; ?></font></b>，欢迎回来<p><span style="color:#4fb4f7;margin-right:8px">角色：<?php echo $_SESSION["role"]; ?> · <a href="../logout.php?sutk=<?php echo $SUtoken; ?>">注销</a></center></li>
  </ul>
</div>
</div>
</nav>
<style>body { padding-top: 70px; }</style>
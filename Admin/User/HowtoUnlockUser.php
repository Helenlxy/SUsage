<?php
require_once("../Includes/CheckLog.php");
$LogURL="../Sys/toLoginLogList.php?sutk=$SUtoken";
$UserURL="toList.php?sutk=$SUtoken";
$UnlockURL="toUnlockUserList.php?sutk=$SUtoken";
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 解锁宝典</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>SUsage 管理中心 :: 解锁宝典</h1>
<hr>
<h4>
  ①向对方索取<font color="green">用户名、姓名、手机号、登录时间段（精确到小时）</font><br>
  ②进入<a href="<?php echo $LogURL; ?>" target="_blank">登录记录</a>筛选时间段内，记录下登录过的用户名。<br>
  ③进入<a href="<?php echo $UserURL; ?>" target="_blank">用户列表</a>筛选对方提供的姓名。若筛选后有记录，并与刚刚记录的用户名匹配，可进行下一步。<br>
  ④使用手机向对方手机号发送随机验证码，并让对方以另一方式返回验证码。<br>
  ⑤验证码校验完成后，进入<a href="<?php echo $UnlockURL; ?>" target="_blank">解锁用户</a>给对方解锁。
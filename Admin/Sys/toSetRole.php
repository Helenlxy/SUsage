<?php
session_start();
$uid=(int)$_GET['uid'];
$set=$_GET['set'];
$type=$_GET['type'];
require_once("../Includes/CheckLog.php");
$flag=true;
require_once("../Includes/to_pdo.php");

$rs=PDOQuery($dbcon,"UPDATE sys_user SET is$type=? WHERE id=?",[$set,$uid],[PDO::PARAM_STR,PDO::PARAM_INT]);
if($rs[1]==1){echo "<script>alert('修改成功！');history.go(-1);</script>";}
else{echo "<script>alert('用户角色修改失败！请联系电脑部');</script>";}
?>
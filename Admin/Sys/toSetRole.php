<?php
require_once("../Includes/CheckLog.php");
$uid=(int)$_GET['uid'];
$set=$_GET['set'];
$type=$_GET['type'];

$flag=true;
require_once("../Includes/to_pdo.php");

switch($type){
  case "Master":
    if($set=="1"){$job="组长";}
    else{$job="组员";}
    break;
  case "Admin":
    $job="管理员";
    break;
  case "Super":
    $job="超级管理员";
    break;
}

if(isset($job)){
  $rs=PDOQuery($dbcon,"UPDATE sys_user SET is$type=?,job=? WHERE id=?",[$set,$job,$uid],[PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_INT]);
}

else{
  $rs=PDOQuery($dbcon,"UPDATE sys_user SET is$type=? WHERE id=?",[$set,$uid],[PDO::PARAM_STR,PDO::PARAM_INT]);
}

if($rs[1]==1){echo "<script>alert('修改成功！');history.go(-1);</script>";}
else{echo "<script>alert('用户角色修改失败！请联系电脑部');</script>";}

?>
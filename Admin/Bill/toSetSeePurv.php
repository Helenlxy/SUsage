<?php
require_once("../Includes/CheckLog.php");
$ids=$_POST['UserIds'];
if($ids==""){
  header("Location: toSetSeePurvList.php?sutk=$SUtoken");
}
$flag=true;
require_once("../Includes/to_pdo.php");
//取消所有人的权限
$cleanall=PDOQuery($dbcon,"UPDATE sys_user_purv SET CanSee=?",["0"],[PDO::PARAM_STR]);
if($cleanall>0){
  //分割成数组
  $uid=explode(",",$ids);
  $or="";$qvalue=array();$qnum=0;
  foreach($uid as $value){
    $or.="Userid=? OR ";
    $qvalue[$qnum++]=[$value,PDO::PARAM_STR];
  }
  //去除最后一个OR
  $or=substr($or,0,strlen($or)-4);
  $sql="UPDATE sys_user_purv SET CanSee='1' WHERE ".$or;
  $rs=PDOQuery2($dbcon,$sql,$qvalue);
  echo $rs[1];
}else{
  //取消所有人的权限 失败
  echo "C";
}
?>
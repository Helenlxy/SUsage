<?php
require_once("../Includes/CheckLog.php");
if(GetSess("isRoot")!="1"){die();}

$flag=true;
require_once("../Includes/to_pdo.php");

$sql="DELETE FROM sys_login_log;ALTER TABLE sys_login_log auto_increment=1;";
$rs=PDOQuery($dbcon,$sql,[],[]);
if($rs[1]>0){
 echo "<script>alert('成功删除所有记录！');history.go(-2);</script>";
}else{
 echo "<script>alert('删除所有记录失败！');history.go(-2);</script>";
}
?>
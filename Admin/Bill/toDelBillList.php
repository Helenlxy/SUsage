<?php
require_once("../Includes/CheckLog.php");
$flag=true;
require_once("../Includes/to_pdo.php");
$id=@$_GET['billid'];
if(!$id || $id=="0"){
  die("非法入侵！");
}

$rs=PDOQuery($dbcon,"DELETE FROM bill_list WHERE Billid=?",[$id],[PDO::PARAM_STR]);
if($rs[1]==1){
  echo "<script>alert('删除成功！');history.go(-1);</script>";
}else{
  echo "<script>alert('删除失败！');history.go(-1);</script>";
}
?>
<?php
require_once("../to_sql.php");
$stuid=$_POST['uid'];
$signn=$_POST['SignN'];
$signd=$_POST['SignD'];
$sign=$_POST['Sign'];
if($signn*$signd%152+233 == $sign){
  $sql="UPDATE sys_user SET isLock='1' WHERE stuid='{$stuid}'";
  $rs=mysqli_query($conn,$sql);
  if($rs=true){
   echo "2";
  }else{
   echo "0";
  }
}else{
  echo "666";
}
?>
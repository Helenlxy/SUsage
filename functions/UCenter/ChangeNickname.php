<?php
session_start();
$Userid=$_SESSION['userid'];
$Nickname=@$_POST['Nickname'];

if($Nickname==""){
  echo "0";
}else{
  require_once("../to_sql.php");
  $sql="SELECT * FROM sys_user WHERE stuid='$Nickname'";
  $query=mysqli_query($conn,$sql);
  $rs=mysqli_fetch_array($query);
  if($rs['id']>0){
    echo "1";
  }else{
    $change_sql="UPDATE sys_user SET stuid='$Nickname' WHERE id='$Userid'";
    $change_rs=mysqli_query($conn,$change_sql);
    if($change_rs==true){
      echo "2";
    }else{
      echo "3";
    }
  }
}
?>
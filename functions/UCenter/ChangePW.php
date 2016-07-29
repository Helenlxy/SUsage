<?php
session_start();
require_once("../SO_API.php");
$pw=@$_POST['PW'];
if($pw==""){
  echo "0";
}else if(isNum($pw)=="1"){
  echo "9";
}else{
  require_once("../to_sql.php");
  
  $salt=random(6);  
  $md5pw=md5($pw.$salt);
  
  $Userid=$_SESSION['userid'];
  $sql="SELECT * FROM sys_user WHERE id='{$Userid}'";
  $query=mysqli_query($conn,$sql);
  $rs=mysqli_fetch_array($query);
  $indb_salt=$rs['salt'];
  $indb_pw=$rs['pw'];
  $check_pw=md5($pw.$indb_salt);

  if($check_pw==$indb_pw){
    echo "1";
  }else{
    $change=mysqli_query($conn,"UPDATE sys_user SET pw='$md5pw',salt='$salt' WHERE id='$Userid'");
    
    if($change==true){
      echo "2";
    }else{
      echo "3";
    }
  }
}
?>
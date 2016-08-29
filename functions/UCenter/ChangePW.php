<?php
session_start();
require_once("../SO_API.php");
$pw=$_POST['PW'];
$check=checkPW($pw);
//Check[0]:不合法的字符串数量
//Check[1]:密码是否拥有三种类型(0,1)
$check=explode("|",$check);

if($pw==""){
  echo "0";
}else if($check[1]!=1){
  echo "CPW1";
}else if($check[0]>0){
  echo "CPW0".$check[0];
}else{
  require_once("../to_sql.php");
  $pw=sha1($pw);
  $Userid=$_SESSION['userid'];
  $change=mysqli_query($conn,"UPDATE sys_user SET pw='{$pw}' WHERE id='$Userid'");
    
  if($change==true){
    echo "2";
  }else{
    echo "3";
  }
}
?>
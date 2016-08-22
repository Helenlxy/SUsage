<?php
session_start();
require_once("../SO_API.php");
$pw=@$_POST['PW'];
$check=checkPW($pw);
$check=explode("|",$check);

if($pw==""){
  echo "0";
}else if($check[1]<2 || $check[0]>0){
  echo "9";
}else{
  require_once("../to_sql.php");
  $pw=SOCGS($pw);  
  $Userid=$_SESSION['userid'];
  $change=mysqli_query($conn,"UPDATE sys_user SET pw='$pw' WHERE id='$Userid'");
    
  if($change==true){
    echo "2";
  }else{
    echo "3";
  }
}
?>
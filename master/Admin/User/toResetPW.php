<?php
session_start();
require_once("../Includes/CheckLog.php");
$flag=true;
require_once("../Includes/to_pdo.php");
$uid=$_POST['uid'];

function random(){
  $salt="";
  $id=mt_rand(104672,891753);//Random
  $srcstr="1sd5g9e8w7p0azx2dcv4bnm3q6";
  for($i=0;$i<6;$i++){
    $salt.=$srcstr[mt_rand(0,25)];
  }
  return $id.$salt;
}

$ran=random();
$pw=substr($ran,0,6);//Get New Password
$salt=substr($ran,5,6);//Get New Salt
$md5=md5($pw.$salt);//MD5 PW+Salt

$rs=PDOQuery($dbcon,"UPDATE sys_user SET pw='{$md5}',salt='{$salt}' WHERE id=?",[$uid],[PDO::PARAM_INT]);
if($rs[1]!=1){die("2");}
die("1|".$pw);
?>
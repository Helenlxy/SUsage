<?php
$flag=true;
require_once("../Includes/to_pdo.php");
require_once("../../functions/SO_API.php");
$uid=$_POST['uid'];
if(!$uid || $uid=0){echo "非法侵入！";break;}


$ran=random(6,"pw");
$pw=substr($ran,0,6);//Get New Password
$salt=substr($ran,5,6);//Get New Salt
$md5=md5($pw.$salt);//MD5 PW+Salt

$rs=PDOQuery($dbcon,"UPDATE sys_user SET pw='{$md5}',salt='{$salt}' WHERE id=?",[$uid],[PDO::PARAM_INT]);
if($rs[1]!=1){die("2");}
die("1|".$pw);
?>
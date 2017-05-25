<?php
session_start();
$flag=true;
require_once("../Includes/to_pdo.php");
require_once("../../functions/SO_API.php");
$uid=$_POST['uid'];
$SessSuper=GetSess("isSuper");

if($SessSuper!="1"){toAlertDie("#403","您无权限访问此网页！");}

$NewPassword=mt_rand(218196,985614);
$HashNewPW=sha1($NewPassword);
$rs=PDOQuery($dbcon,"UPDATE sys_user SET pw=? WHERE id=?",[$HashNewPW,$uid],[PDO::PARAM_STR,PDO::PARAM_INT]);
if($rs[1]!=1){die("2");}
die("1|".$NewPassword);
?>
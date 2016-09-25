<?php
$flag=true;
require_once("../Includes/to_pdo.php");

$Truename=$_POST['TrueName'];
$Phone=$_POST['UserName'];
$Dep=$_POST['Dep'];

$pw=(string)mt_rand(4258719,9617532);
$sha1pw=sha1($pw);

$sql="INSERT INTO sys_user SET stuid = ?, tname = ?, dep = ?, pw = ?, Phone = ?";
$addrs=PDOQuery($dbcon,$sql,[ $Phone , $Truename , $Dep , $sha1pw , $Phone ] , [PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR]);

$uidrs=PDOQuery($dbcon,"SELECT * FROM sys_user WHERE Phone = ?",[$Phone],[PDO::PARAM_STR]);
$Userid=(string)$uidrs[0][0]['id'];

$purrs=PDOQuery($dbcon,"INSERT INTO sys_user_purv SET Userid = ?",[$Userid],[PDO::PARAM_STR]);

echo $addrs[1]."|".$purrs[1]."|".$pw;
?>
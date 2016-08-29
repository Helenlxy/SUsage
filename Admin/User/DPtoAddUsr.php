<?php
$flag=true;
require_once("../Includes/to_pdo.php");
require_once("../../functions/SO_API.php");

$tname=$_POST['tname'];
$SUsageID=$_POST['usr'];
$dep=$_POST['dep'];

$pw=(string)mt_rand(104672,961753);
$indb=sha1($pw);

$addrs=PDOQuery($dbcon,"INSERT INTO sys_user SET stuid=?, tname=?, dep=?, pw=?",[$SUsageID,$tname,$dep,$indb],[PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR]);

$uidrs=PDOQuery($dbcon,"SELECT * FROM sys_user WHERE stuid=?",[$SUsageID],[PDO::PARAM_STR]);
$Userid=$uidrs[0][0]['id'];

$purrs=PDOQuery($dbcon,"INSERT INTO sys_user_purv SET Userid=?",[$Userid],[PDO::PARAM_STR]);

echo $addrs[1]."|".$purrs[1]."|".$pw;
?>
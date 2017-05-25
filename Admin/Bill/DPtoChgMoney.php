<?php
$flag=true;
require_once("../Includes/to_pdo.php");
require_once("../../functions/SO_API.php");
$p=$_POST['p'];
$i=$_POST['i'];
$s=$_POST['s'];
$ip=GetIP();
$update=PDOQuery($dbcon,"INSERT INTO bill_money SET pay=?, income=?, surplus=?, ip=?",[$p,$i,$s,$ip],[PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR]);
echo $update[1];
?>
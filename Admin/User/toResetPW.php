<?php
$flag=true;
require_once("../Includes/to_pdo.php");
require_once("../../functions/SO_API.php");
require_once("../../functions/socgs.php");
$uid=$_POST['uid'];

$ran=(string)mt_rand(104672,961753);
$pw=SOCGS($ran);

$rs=PDOQuery($dbcon,"UPDATE sys_user SET pw=? WHERE id=?",[$pw,$uid],[PDO::PARAM_STR,PDO::PARAM_INT]);
if($rs[1]!=1){die("2");}
die("1|".$ran);
?>
<?php
$flag=true;
require_once("../Includes/to_pdo.php");
$id=$_POST["id"];

$rs=PDOQuery($dbcon,"DELETE from task_list WHERE Taskid=?",[$id],[PDO::PARAM_INT]);
$rs2=PDOQuery($dbcon,"DELETE from task_complete WHERE Taskid=?",[$id],[PDO::PARAM_STR]);

$die=$rs[1];
if($rs[1]==1){die("1");}
else{die($die);}

?>
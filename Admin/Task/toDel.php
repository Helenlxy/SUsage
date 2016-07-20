<?php
$flag=true;
require_once("../Includes/to_pdo.php");
$id=$_POST["id"];

//没有任何POST数据，意指直接URL访问
if(!$id || $id==0){die("非法入侵！");}

$rs=PDOQuery($dbcon,"DELETE from task_list WHERE Taskid=?",[$id],[PDO::PARAM_INT]);

$die=$rs[1];
if($rs[1]==1){die("1");}
else{die($die);}

?>
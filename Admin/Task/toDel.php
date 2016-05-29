<?php
$flag=true;
require_once("../Includes/to_pdo.php");
$id=$_POST["id"];
if(!$id || $id=0){echo "非法侵入！";break;}
$rs=PDOQuery($dbcon,"DELETE from task_list WHERE id=?",[$id],[PDO::PARAM_INT]);

$die=$rs[1];
if($rs[1]==1){die("1");}
else{die($die);}

?>
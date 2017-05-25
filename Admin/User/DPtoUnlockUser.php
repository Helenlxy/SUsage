<?php
session_start();
require_once("../../functions/SO_API.php");

if(GetSess("isRoot")!="1"){
 header("Location: toList.php?sutk=$SUtoken");
}

if(isset($_POST) && $_POST){
 $flag=true;
 require_once("../Includes/to_pdo.php");
 $uid=(int)$_POST['Userid'];
 $rs=PDOQuery($dbcon,"UPDATE sys_user SET isLock=? WHERE id=?",["0",$uid],[PDO::PARAM_STR,PDO::PARAM_INT]);
 echo($rs[1]);
}
?>
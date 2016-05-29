<?php
session_start();
//This Page Was not built success

//Please Delete This Code online
/*$_SESSION['isAdmin']="1";
$_SESSION['isSuper']="1";
$_SESSION['name']="小生蚝";
$_SESSION['role']="超级管理员";
$_SESSION['SUtoken']="A9XB184MQ0WK";*/
//Please Delete This Code online

$SUtoken=$_GET['sutk'];
if($SUtoken != $_SESSION['SUtoken'] || !$SUtoken || !$_SESSION['SUtoken']){
  header("Location: /SUsage/Admin/login.php");
}
?>
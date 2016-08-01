<?php
session_start();

$SUtoken=$_GET['sutk'];
if($SUtoken != $_SESSION['SUtoken'] || !$SUtoken || !$_SESSION['SUtoken']){
  header("Location: /SUsage/Admin/login.php");
}
?>
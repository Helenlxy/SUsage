<?php
session_start();
include("../../functions/SO_API.php");

$SUtoken=$_GET['sutk'];
if($SUtoken != $_SESSION['SUtoken'] || !$SUtoken || !$_SESSION['SUtoken']){
  header("Location: ../Admin/login.php");
}

function CheckPurv($name){
  $purvret=MC_auth($name,$_SESSION['isAdmin'],$_SESSION['isSuper'],$_SESSION['isRoot']);
  if($purvret=="0"){header("Location: ../Task/toList.php?sutk=$SUtoken");}
}
?>
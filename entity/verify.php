<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/SO_API.php");
require_once("../functions/socgs.php");
if(isset($_POST) && $_POST){
	$StuID=$_POST['id'];
	$sql="SELECT * FROM sys_user WHERE stuid='{$StuID}'";
	$pw=$_POST['pw'];
	
	$query=mysqli_query($conn,$sql);
	$rs=mysqli_fetch_array($query);
	
	$pwcheck=SOCGS_Check($pw,$rs['pw']);
	if($rs['isLock']=="0"){
		if($pwcheck=="1"){
		$_SESSION['nickname']=$StuID;
		$_SESSION['headimg']=$rs['headimg'];
		$_SESSION['userid']=$rs['id'];
		$_SESSION['truename']=$rs['tname'];
		if(strstr($rs['dep'],",")){
		 $deparray=explode(",",$rs['dep']);
		 for($i=0;$i<sizeof($deparray);$i++){
		  $_SESSION['dep'][$i]=$deparray[$i];
		 }
		}else{
		 $_SESSION['dep'][0]=$rs['dep'];
		}
		
		$sql2="SELECT * FROM sys_user_purv WHERE Userid='{$rs["id"]}'";
		$query2=mysqli_query($conn,$sql2);
		$rs2=mysqli_fetch_array($query2);
		$_SESSION['SU_See']=$rs2['CanSee'];
		$_SESSION['SU_M']=$rs2['isMaster'];
		
		$ip=GetIP();
		$Lastrs=mysqli_query($conn,"INSERT INTO sys_login_log SET UserName='{$rs["tname"]}', IPAddress='{$ip}'");
		
		die("1");
	}else if($pwcheck=="0"){
	 die("2");
	}
	}else{
		die("233");
	}
}else{
	die("9");
}
?>

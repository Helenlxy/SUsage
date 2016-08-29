<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/SO_API.php");
$SessName=array("nickname","headimg","userid","truename");

if(isset($_POST) && $_POST){
	$UserName=$_POST['id'];
	$sql="SELECT * FROM sys_user WHERE stuid='{$UserName}'";
	$pw=$_POST['pw'];
	$SHA1pw=sha1($pw);
	
	$query=mysqli_query($conn,$sql);
	$rs=mysqli_fetch_array($query);
	
	if($rs['isLock']=="0"){
		if($SHA1pw === $rs['pw']){
		
		$SessValue = array($UserName,$rs['headimg'],$rs['id'],$rs['tname']);
		SetSess($SessName,$SessValue);

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
		$UA=$_SERVER['HTTP_USER_AGENT'];
		$SessID=session_id();
		$AddLog=AddLoginLog($conn,$rs['tname'],$pw,$UA,$SessID,$ip);
		
		die("1");
	}else{
	 //Wrong PW
	 die("2");
	}
	}else{
	 // Lock
		die("233");
	}
}else{
 // No Data
	die("9");
}
?>

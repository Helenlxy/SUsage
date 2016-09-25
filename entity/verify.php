<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/SO_API.php");

$SessName=array("nickname","headimg","userid","truename");
$ip=GetIP();
$UA=$_SERVER['HTTP_USER_AGENT'];
$SessID=session_id();
$Time=date("Ymd H:i");

$query=mysqli_query($conn,"SELECT * FROM login_token WHERE SessionID='{$SessID}'");
$rs_L=mysqli_fetch_array($query);
$isnull2=is_null($rs_L['id']);
if($isnull2 != TRUE){}
else if($isnull2 = TRUE){
 $query_LA=mysqli_query($conn,"INSERT INTO login_token SET SessionID='{$SessID}', LoginTime='{$Time}'");
}

if(isset($_POST) && $_POST){
	$UserName=$_POST['id'];
	$pw=$_POST['pw'];
	$SHA1pw=sha1($pw);
	
	$sql="SELECT * FROM sys_user WHERE stuid='{$UserName}'";	
	$query=mysqli_query($conn,$sql);
	$rs=mysqli_fetch_array($query);
	
	if($rs_L['ErrorCount'] >= 5){
  $Locking=mysqli_query($conn,"UPDATE sys_user SET isLock='1' WHERE stuid='{$UserName}'");
  die("233");
 }else{
  $ErrorCount=$rs_L['ErrorCount'];
 }
 
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
			
	 	$AddLog=AddLoginLog($conn,"Q",$rs['tname'],$pw,$UA,1,$SessID,$ip);
		
		 die("1");
	 }else{//Wrong PW	  
	  $ErrorCount++;
	  if($rs['id']>0){
	   $AddLog=AddLoginLog($conn,"Q",$rs['tname'],$pw,$UA,0,$SessID,$ip);   
	   $rs2=mysqli_query($conn,"UPDATE login_token SET ErrorCount='{$ErrorCount}' WHERE SessionID='{$SessID}'");
	  }else{//未知用户	
	   $AddLog=AddLoginLog($conn,"Q",$UserName,$pw,$UA,"U",$SessID,$ip);
	   $rs2=mysqli_query($conn,"UPDATE login_token SET ErrorCount='{$ErrorCount}' WHERE SessionID='{$SessID}'");
	  }
	 die("2");
 	}
 	
	}else if($rs['isLock']=="1"){//锁定用户
	 $AddLog=AddLoginLog($conn,"Q",$rs['tname'],$pw,$UA,"L",$SessID,$ip);
		die("233");
	}
	
}else{
 die("<center><b><h1>404 Not Found<br><hr></h1><h3>Nginx");
}
?>

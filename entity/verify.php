<?php 
session_start();
require_once("../functions/to_sql.php");
if(isset($_POST) && $_POST){
	$StuID=$_POST['id'];
	$sql="SELECT * FROM sys_user WHERE stuid='{$StuID}'";
	$query=mysqli_query($conn,$sql);
	$rs=mysqli_fetch_array($query);
	$salt=$rs["salt"];
	$pw=md5($_POST["pw"].$salt);
	if($pw == $rs['pw']){
		$_SESSION['nickname']=$StuID;
		$_SESSION['headimg']=$rs['headimg'];
		$_SESSION['userid']=$rs['id'];
		$_SESSION['SUmaster']=$rs['isMaster'];
		$_SESSION['group']=$rs['dep'];
		$_SESSION['truename']=$rs['tname'];
		die("1");
	}else if($pw != $rs['pw']){
		//密码不符
		die("2");
	}else{
		//网络连接出错 | 未知错误
		die("3");
	}
}else{
	//没有POST数据
	die("9");
}
?>

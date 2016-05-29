<?php
 header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Shanghai");	$conn=@mysqli_connect("localhost","输入你的数据库用户名","输入你的数据库密码","susage_oa");
	if(mysqli_connect_errno($conn)){
		die("无法连接数据库，错误代码:".mysqli_connect_errno($conn));
	}
	mysqli_set_charset($conn,"utf8");
?>

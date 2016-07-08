<?php
 header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Shanghai");	$conn=@mysqli_connect("localhost","root","","susage_oa");
	if(mysqli_connect_errno($conn)){
		die("Oops！十分抱歉，也许是出了些差错。当前的系统状态：[无法连接数据库]，以下的错误代码也许对您有所帮助：".mysqli_connect_errno($conn));
	}
	mysqli_set_charset($conn,"utf8");
?>

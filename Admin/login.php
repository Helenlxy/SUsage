<?php
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/SO_API.php");

$SessName=array("name","isAdmin","isSuper","isRoot","role","SUtoken");
$ip=GetIP();
$UA=$_SERVER['HTTP_USER_AGENT'];
$SessID=session_id();
	
if(isset($_POST) && $_POST){

 $StuID=$_POST['id'];
 $pw=$_POST['pw'];
 /*$Check=CheckPW($pw);
	$ArrCheck=explode("|",$Check);
	if($ArrCheck[0]>0 || $ArrCheck[1]!=1){
	 die($Check);
	}*/
 $SHA1pw=sha1($pw);
 
 $query=mysqli_query($conn,"SELECT * FROM sys_user WHERE stuid='{$StuID}'");
 $rs=mysqli_fetch_array($query);
 
 if($rs['id']<=0 || $rs['id']=="" || $SHA1pw != $rs['pw']){
  echo "<script>alert('用户名或密码错误！');</script>";
  $AddLog=AddLoginLog($conn,"M",$_POST['id'],$pw,$UA,6,$SessID,$ip);
 }
 
 //判断用户输入的密码是否正确
 if($SHA1pw === $rs['pw']){
 
  //获取当前用户权限
  $sql2="SELECT * FROM sys_user_purv WHERE Userid='{$rs["id"]}'";
  $query2=mysqli_query($conn,$sql2);
  $rs2=mysqli_fetch_array($query2);

  //如果用户是管理员级别以上
  if($rs2['isAdmin']=="1"){
   //获取Token
   $token=random(10);
   
   //获取权限并制定角色名称
   $SuperPurv=$rs2['isSuper'];
   $RootPurv=$rs2['isRoot'];
   if($RootPurv=="1"){
     $RoleName="网站管理员";
   }else if($SuperPurv=="1"){
     $RoleName="超级管理员";
   }else{
     $RoleName="管理员";
   }
   
   //设置Session
   $SessValue=array($rs['tname'],"1",$SuperPurv,$RootPurv,$RoleName,$token);
   SetSess($SessName,$SessValue);
   
   $AddLog=AddLoginLog($conn,"M",$rs['tname'],$pw,$UA,"M",$SessID,$ip);
   
   header("Location: Task/toPubGlobalNotice.php?sutk=$token");
  }else{
   echo "<script>alert('对不起！您未被授权登录SUsage Mcenter！');history.go(-1);</script>";
  }
 }
}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SUsage 管理中心 :: 登录</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
  a{color:#fff;}
  a:hover{color:#fff}
  p{color:#fff;}
  </style>
</head>
<body style="font-family:Microsoft YaHei;padding-top:100px;background-color:#66BB6A">
<br>
<div class="container text-center">
<div class="row text-center" style="padding-top:40px"> 
<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
  <h3 style="color:#4CAF50">欢迎回来，SUsage Administrator</h3>
  <div class="col-md-offset-2 col-md-8" style="line-height:12px;">
    <form method="post" id="login">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="输入你的用户名" name="id" autocomplete="off">
      </div>
      <br>
      <div class="input-group">
        <input type="password" class="form-control" placeholder="输入你的密码" name="pw">
      </div>
      <br>
      <input type="submit" class="btn btn-success" style="width:100%" value="登录">
      <br>     
    </form>
  </div>
</div>
</div>
</div>

<!-- JavaScript -->
<script src="Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
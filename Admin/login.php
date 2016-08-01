<?php
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/SO_API.php");


if(isset($_POST) && $_POST){
  $StuID=$_POST['id'];
  $query=mysqli_query($conn,"SELECT * FROM sys_user WHERE stuid='{$StuID}'");
  $rs=mysqli_fetch_array($query);
  //获取Salt并结合输入的密码进行加密
  $salt=$rs["salt"];
  $pw=md5($_POST["pw"].$salt);
  if($rs['isAdmin']=="1" || $rs['isSuper']=="1"){
    if($pw == $rs['pw']){
      //真实姓名
      $_SESSION['name']=$rs['tname'];
      //各种权限
      $_SESSION['isMaster']=$rs['isMaster'];
      $_SESSION['isAdmin']=$rs['isAdmin'];
      $_SESSION['isSuper']=$rs['isSuper'];
      //用户角色名称
      $_SESSION['role']=$rs['job'];
      //获取Token
      $token=random(10);
      $_SESSION['SUtoken']=$token;
      header("Location: console.php?sutk=$token");
    }else{ 
      echo "<script>alert('用户名或密码错误！');history.go(-1);</script>";
    }
  }else{ 
    echo "<script>alert('对不起！您未被授权登录SUsage Mcenter!');history.go(-1);</script>";
  }
  
  
  
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SUsage 管理中心 :: 登录</title>
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
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
        <input type="text" class="form-control" placeholder="输入你的用户名" name="id" id="id" onkeyup="if(event.keyCode==13)$('#pw')[0].focus();">
      </div>
      <br>
      <div class="input-group">
        <input type="password" class="form-control" placeholder="输入你的密码" name="pw" id="pw" onkeyup="if(event.keyCode==13)toLogin();">
      </div>
      <br>
      <button class="btn btn-success" style="width:100%" onclick="toLogin();">登录</button>
      <br>
     
    </form>
  </div>
</div>
</div>
</div>
<script src="/SUsage/Admin/Includes/footer.js"></script>
<script src="/SUsage/res/js/jquery-2.2.1.min.js"></script>
<script src="/SUsage/Admin/js/bootstrap.js"></script>

<script>
function toLogin(){
$('login').submit();}
</script>

</body>
</html>
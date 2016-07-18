<?php 
session_start();
require_once("../functions/to_sql.php");
if(isset($_POST) && $_POST){
  $StuID=$_POST['id'];
  $query="SELECT * FROM sys_user WHERE stuid='{$StuID}'";
  $rs=mysqli_fetch_array(mysqli_query($conn,$query));
  $salt=$rs["salt"];
  $pw=md5($_POST["pw"].$salt);
  if($pw == $rs['pw']){
    $_SESSION['nickname']=$StuID;
    $_SESSION['headimg']=$rs['headimg'];
    $_SESSION['userid']=$rs['uid'];
    $_SESSION['SUmaster']=$rs['isMaster'];
    $_SESSION['group']=$rs['depgroup'];
    $_SESSION['SUname']=$rs['tname'];
    header("Location: index.php");
  }
  
  else{ 
    
  }
  
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>欢迎回来 / SUsage Login</title>
  <link rel="stylesheet" type="text/css" href="/SUsage/res/css/modules/ex-ucenter.css">
<link rel="stylesheet" href="../res/css/themes/Sinterface.css" />
  <link rel="shortcut icon" href="/SUsage/res/icons/title/login_128X128.ico"/>
</head>

<body style="padding-top:120px;background-color:#64B5F6">
<!--通知popup-->
<div class="toast" id="codetips" style="background-color:#D50000;position:fixed;top:0px;width:100%;height:30px;z-index:100;display:none;">
<p style="font-family:微软雅黑;color:#ffffff;position:absolute;left:42%;line-height:0px;">孩纸不急~先把密码输对哦！</p>
</div>

<article style="margin-top:50px">
  <center class="card" style="background-color: #fff;width:35%;min-height:350px">
    <h2 class="fs-title" style="font-size: 25px">你好，SUer
      <br><h3 style="color:#66ccff">欢迎回到SUsage</h3>
    </h2>
    <input class="text-input ipt" required="required" placeholder="SUsage ID" id="id">
    <input class="text-input ipt" type="password" required="required" placeholder="Password" id="pw">
    <button onclick="tologin();" id="btn" class="btn raised green" style="width:60%;margin-top:40px">登陆</button>
  </center>

  <!-- Footer -->
  <center style="font-size:12px;color:#ffffff;padding-top:490px"><b>SUsage</b> 桌面版1.0 · <a onClick="displaytips(); return false" style="color:#FFFFFF">[点此测试密码提示]</a> · <a href="https://github.com/zhxsu/SUsage/wiki/%E5%B8%AE%E5%8A%A9%E4%B8%8E%E5%8F%8D%E9%A6%88%E4%B8%AD%E5%BF%83-%7C-Hints-&-Feedbacks" target="_blank" style="color:#ffffff">帮助与反馈中心 </a>·<a href="http://zhxsu.github.io/SUsage/" target="_blank" style="color:#ffffff"> 关于 | 开源许可及协议声明 </a>· ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#ffffff;text-decoration:underline">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#ffffff;text-decoration:underline">电脑部</a> · In tech we trust</center>
</article>
</body>

<script src="/SUsage/res/js/jquery-2.2.1.min.js" type="text/javascript"></script>
<script src="/SUsage/res/js/md5.js" type="text/javascript"></script>

<script type="text/javascript">
var tips = document.getElementById('codetips');
function displaytips(){ 
  tips.style.display = "block";
  setTimeout("tips.style.display='none'",3000);
}
</script>
<script>
function tologin(){
  $("#id")[0].disabled=1;
  $("#pw")[0].disabled=1;
  $("#btn")[0].disabled=1;
  $("#btn").html("验证中");
  var id=$("#id").val();
  var pw=$("#pw").val();
}
</script>
</html>
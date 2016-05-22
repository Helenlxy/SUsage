<?php 
session_start();
$flag=true;
require_once("../functions/to_sql.php");
require_once("../functions/Jerry-API.php");
if($_POST['login']){
  $StuID=$_POST['id'];
  $pwd=md5(md5($_POST['pwd']));
  $query="SELECT * FROM user_list WHERE stuid='{$StuID}'";
  $rs=mysqli_fetch_array(mysqli_query($conn,$query));
  if($pwd == $rs['pw']){
    header("Location: index.php");
    $_SESSION['nickname']=$StuID;
    $_SESSION['headimg']=$rs['headimg'];
    $_SESSION['userid']=$rs['uid'];
  }
  
  else{ 
    // TODO 弹出提示语
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
  <link rel="stylesheet" type="text/css" href="/SUsage/res/css/md/loginstyles.css">
  <link rel="shortcut icon" href="/SUsage/res/icons/title/login_128X128.ico"/>
</head>

<body style="padding-top:120px">
<!--通知popup-->
<div class="toast" id="codetips" style="background-color:#D50000;position:fixed;top:0px;width:100%;height:30px;z-index:100;display:none;">
<p style="font-family:微软雅黑;color:#ffffff;position:absolute;left:42%;line-height:0px;">孩纸不急~先把密码输对哦！</p>
</div>

  <article class="htmleaf-container">
    <div class="panel-lite1">
      <h4>你好，SUer
        <p>欢迎回到SUsage</p></h4>
        <form method="post" name="login">

            <div class="form-group">
              <input required="required" class="form-control" placeholder="SUsage ID" name="id">
            </div>
            <div class="form-group">
              <input type="password" required="required" class="form-control" placeholder="Password" name="pwd">
            </div>

         <input type="submit" name="login" class="submit action-button" value="登陆">
         <p><a style="position:relative;bottom:25px;font-size:14px" href="register.php">没有账号？现在注册 ></a></p>
      </form>
    </div>

<!-- Footer -->
<div style="font-size:12px;color:#ffffff;padding-top:90px"><b>SUsage</b> 桌面版1.0 · <a onClick="displaytips(); return false" style="color:#FFFFFF">[点此测试激活码提示]</a> · <a href="https://github.com/zhxsuwebgroup/SUsage/wiki/%E5%B8%AE%E5%8A%A9%E4%B8%8E%E5%8F%8D%E9%A6%88%E4%B8%AD%E5%BF%83-%7C-Hints-&-Feedbacks" target="_blank" style="color:#ffffff">帮助与反馈中心 </a>·<a href="http://zhxsuwebgroup.github.io/SUsage/" target="_blank" style="color:#ffffff"> 关于 | 开源许可及协议声明 </a>· ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#ffffff;text-decoration:underline">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#ffffff;text-decoration:underline">电脑部</a> · In tech we trust</div>
</article>

  </body>

<script src="/SUsage/res/js/jquery-2.2.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
  var tips = document.getElementById('codetips');
  function displaytips() { 
    tips.style.display = " block " ;
    setTimeout("tips.style.display='none'",3000);
  }  
   
</script>
</html>

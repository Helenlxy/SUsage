<?php
require_once("../Includes/CheckLog.php");
$all=file_get_contents("../../GlobalNotice.json");
$all=json_decode($all);
$Notice=urldecode($all->notice);
$pubman=$all->pubman;
$pubtime=$all->pubtime;

if(isset($_POST) && $_POST){
  $content=$_POST['content'];
  $urlcode=urlencode($content);
  $time=date("n月j日");
  $man=$_SESSION['name'];
  $input='{"pubman":"'.$man.'","pubtime":"'.$time.'","notice":"'.$urlcode.'"}';
  
  if(file_put_contents("../../GlobalNotice.json",$input) > 0){
    echo "<script>alert('发布成功！');history.go(-1);</script>";
  }else{
    echo "<script>alert('发布失败！请联系系统管理员！');history.go(-1);</script>";
  }
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 发布全局公告</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.bootcss.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.svg" rel="stylesheet">
  
  <style>
  a{color:#4caf50;}
  a:hover{color:#4fb4f7;transition: 0.6s;}
  </style>
</head>

<body>
<?php include("../Includes/shownav.php"); ?>
<div class="container text-center">
<div class="row text-center" style="padding-top:40px"> 
<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
  <h3 style="color:#4CAF50">发布全局公告</h3><hr>
  <h4><font color="#FFA000"><b>当前公告</b></font></h4>发布人：<?php echo $pubman; ?><br>发布时间：<?php echo $pubtime; ?><br>公告内容：<?php echo $Notice; ?><br><hr>
  <a style="position:absolute;top:20px;left:5%;cursor:pointer" onclick="history.back()"><img src="../img/back.png"></a>
  <div class="col-md-offset-2 col-md-8" style="line-height:12px;">
  
<form method="post">
  <div class="input-group">
    <textarea class="form-control" style="resize:none;" name="content" cols="65" rows="10" placeholder="输入全局通知的内容"></textarea>
  </div><br>
  <input type="submit" value="发 布" class="btn btn-success" style="width:100%">
</form>
</div>
</div>
</div>
</div>
</body>


<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>

</html>
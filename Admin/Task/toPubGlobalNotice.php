<?php
require_once("../Includes/CheckLog.php");
$flag=true;
require_once("../Includes/to_pdo.php");

if(isset($_POST) && $_POST){
  $topic=$_POST['topic'];
  $content=$_POST['content'];
  
  $rs=PDOQuery($dbcon,"INSERT INTO sys_notice SET topic=?, content=?",[$topic,$content],[PDO::PARAM_STR,PDO::PARAM_STR]);
  
  if($rs[1]!=0){
    echo "<script>alert('发送成功');</script>";
  }
  else{echo 1;}
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 发布全局公告</title>
  
  <!-- Bootstrap -->
  <link href="/SUsage/Admin/css/bootstrap.css" rel="stylesheet">
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
  <h3 style="color:#4CAF50">发布全局公告</h3><br>
  <a style="position:absolute;top:13px;left:5%;cursor:pointer" onclick="history.back()">返回上一页</a>
  <div class="col-md-offset-2 col-md-8" style="line-height:12px;">
  
<form method="post">

<div class="input-group">
    <textarea class="form-control" style="resize:none;" name="content" cols="65" rows="10" placeholder="输入内容"></textarea>
</div><br>
<input type="submit" value="发 布" class="btn btn-success" style="width:100%">
</form>
</div>
</div>
</div>
</div>
</body>


<script src="/SUsage/Admin/Includes/footer.js"></script>
<script src="/SUsage/res/js/jquery-2.2.1.min.js"></script>
<script src="/SUsage/Admin/js/bootstrap.js"></script>
</html>
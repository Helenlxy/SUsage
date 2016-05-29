<?php
require_once("../Includes/CheckLog.php");
$flag=true;
require_once("../Includes/to_pdo.php");
$uid=(int)$_GET['uid'];
$name=$_GET['name'];

//获取用户提交的数据
if(isset($_POST) && $_POST){
  $stuid=$_POST['stuid'];
  $dep=$_POST['dep'];
  $group=$_POST['group'];
  
  //检测提交的数据是否为空
  if(!$dep)
  {echo "<script>alert('请认真准确填写所需修改内容！');</script>";}
  
  else{
    //执行更改
    $rs=PDOQuery($dbcon,"UPDATE sys_user SET stuid='{$stuid}',dep='{$dep}',depgroup='{$group}' WHERE id=?",[$uid],[PDO::PARAM_INT]);
    if($rs[1]==1){echo "<script>alert('恭喜您，修改成功！');history.go(-2);</script>";}//Success
    else{echo "<script>alert('对不起，修改失败！请联系电脑部。'.$rs[1]);history.go(-1);</script>";}//False
  }
}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SUsage 管理中心 :: 用户编辑</title>

<!-- Bootstrap -->
<link href="/SUsage/Admin/css/bootstrap.css" rel="stylesheet">

<style>
  a{color:#4caf50;}
  a:hover{color:#4fb4f7;transition: 0.6s;}
</style>

</head>
<body style="font-family:Microsoft YaHei;">
<?php include("../Includes/shownav.php"); ?>
<br>
<div class="container text-center">
<div class="row text-center" style="padding-top:40px"> 
<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
  <h3 style="color:#4CAF50">修改 <font color="#CC6600"><?php echo $name; ?></font> 的用户资料</h3><br>
  <a style="position:absolute;top:13px;left:5%;cursor:pointer" onclick="history.back()">返回上一页</a>
  <div class="col-md-offset-2 col-md-8" style="line-height:12px;">
  
<form method="post">
  <div class="input-group">
    <input class="form-control" placeholder="输入新的用户名" name="stuid">
  </div><br>
  
  <div class="input-group">
    <input class="form-control" placeholder="输入新的部门" name="dep">
  </div><br>
  
  <div class="input-group">
    <input class="form-control" placeholder="输入新的组别" name="group">
  </div><br>
  
  <input type="submit" value="修 改" class="btn btn-success" style="width:100%">
      <br>     
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
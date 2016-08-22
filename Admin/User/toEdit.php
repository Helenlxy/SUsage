<?php
require_once("../Includes/CheckLog.php");
CheckPurv("U_E");

$flag=true;
require_once("../Includes/to_pdo.php");
$uid=(int)$_GET['uid'];
$name=$_GET['name'];

//获取用户提交的数据
if(isset($_POST) && $_POST){
  $stuid=$_POST['stuid'];
  $dep=$_POST['dep'];
  
  //检测提交的数据是否为空
  if(!$dep){
    echo "<script>alert('请认真准确填写所需修改内容！');</script>";
  }else{//执行更改
    if($stuid!=""){//修改用户名 & 部门
      $rs=PDOQuery($dbcon,"UPDATE sys_user SET stuid='{$stuid}',dep='{$dep}' WHERE id=?",[$uid],[PDO::PARAM_INT]);
    }else{
      $rs=PDOQuery($dbcon,"UPDATE sys_user SET dep='{$dep}' WHERE id=?",[$uid],[PDO::PARAM_INT]);
    }
    
    if($rs[1]==1){//Success
      echo "<script>alert('恭喜您，修改成功！');history.go(-2);</script>";
    }else{//False
      echo "<script>alert('对不起，修改失败！请联系电脑部。'.$rs[1]);history.go(-1);</script>";
    }
  }
}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SUsage 管理中心 :: 用户编辑</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

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
  <a style="position:absolute;top:13px;left:5%;cursor:pointer" onclick="history.back()"><img src="../img/back.png"></a>
  <div class="col-md-offset-2 col-md-8" style="line-height:12px;">
  
<form method="post">
  <div class="input-group">
    <input class="form-control" placeholder="输入新的用户名（不修改请留空）" name="stuid">
  </div><br>
  
  <div class="input-group">
    <input class="form-control" placeholder="输入新的部门（双电请填写电视台 or 电脑部）" name="dep">
  </div><br>
    
  <input type="submit" value="修 改" class="btn btn-success" style="width:100%">
      <br>     
    </form>
  </div>
</div>
</div>
</div>
</body>


<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>

</html>
<?php
require_once("../Includes/CheckLog.php");
$flag=true;
require_once("../Includes/to_pdo.php");
CheckPurv("B");

if(isset($_POST) && $_POST){
 $v1=$_POST['1'];
 $v2=$_POST['2'];
 $v3=$_POST['3'];
 $v4=$_POST['4'];
 $v5=$_POST['5'];
 $rs=PDOQuery($dbcon,"INSERT INTO bill_list SET BillName=?, Content=?, Income=?, Cost=?, Registrant=?",[$v1,$v2,$v4,$v3,$v5],[PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR]);
 if($rs[1]=="1"){
  echo "<script>alert('新增成功！');</script>";
 }else{
  echo "<script>alert('新增失败！');</script>";
 }
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 账务系统</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <style>
  a{color:#4caf50;}
  a:hover{color:#4fb4f7;transition: 0.6s;}
  </style>
</head>

<body>
<?php include("../Includes/shownav.php"); ?>
<div class="container text-center">
<div class="row text-center" style="padding-top:20px"> 
<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
<h3 style="color:#4CAF50">新增账单</h3><br>
  <a style="position:absolute;top:13px;left:5%;cursor:pointer" onclick="history.back()"> <返回</a>
  <div class="col-md-offset-2 col-md-8" style="line-height:12px;">
  
  <form method="post">
  <input type="hidden" name="5" value="<?php echo $_SESSION['name']; ?>">
  <div class="input-group">
    <input class="form-control" name="1" autocomplete="off" placeholder="账单名称">
  </div><br>
  
  <div class="input-group">
    <input class="form-control" name="2" autocomplete="off" placeholder="账单内容">
  </div><br>
  
  <div class="input-group">
    <input class="form-control" name="3" autocomplete="off" placeholder="此单支出">
  </div><br>
  
  <div class="input-group">
    <input class="form-control" name="4" autocomplete="off" placeholder="此单收入">
  </div><br>

  <input type="submit" class="btn btn-info" style="width:100%" name="addbtn" value="添加账单">
  </form>
  <br>
</div>
</div>
</div>
</div>
</body>

<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script>
</script>
</html>
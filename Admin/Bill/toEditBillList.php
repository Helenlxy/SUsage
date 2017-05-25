<?php
require_once("../Includes/CheckLog.php");
CheckPurv("B");

$flag=true;
require_once("../Includes/to_pdo.php");
$id=$_GET['billid'];
if(!$id || $id=="0"){
  header("Location: toBillList.php?sutk=$SUtoken");
}

$BillList=PDOQuery($dbcon,"SELECT * FROM bill_list WHERE Billid=?",[$id],[PDO::PARAM_STR]);

//没有这张账单
if($BillList[1]==0){
  header("Location: toBillList.php?sutk=$SUtoken");
}

//获取账单内容
$Name=$BillList[0][0]["BillName"];
$Content=$BillList[0][0]["Content"];
$Income=$BillList[0][0]["Income"];
$Cost=$BillList[0][0]["Cost"];
$Registrant=$BillList[0][0]["Registrant"];

//提交数据的处理
if(isset($_POST) && $_POST){
  $PostName=$_POST['BillName'];
  $PostContent=$_POST['Content'];
  $PostCost=$_POST['Cost'];
  $PostIncome=$_POST['Income'];

  $SQL="UPDATE bill_list SET BillName=?, Content=?, Cost=?, Income=? WHERE billid=?";
  $UpdateBill=PDOQuery($dbcon,$SQL,[$PostName,$PostContent,$PostCost,$PostIncome,$id],[PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_STR]);
  
  if($UpdateBill[1]==1){
    echo "<script>alert('恭喜您，修改成功！');history.go(-2);</script>";
  }else{
    echo "<script>alert('修改失败！');history.go(-2);</script>";
  }
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 编辑账单</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
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
  <h3 style="color:#4CAF50">编辑账单</h3><br>
  <a style="position:absolute;top:13px;left:5%;cursor:pointer" onclick="history.back()"> <返回</a>
  <div class="col-md-offset-2 col-md-8" style="line-height:12px;">

<form class="form-horizontal" method="post">
  <div class="form-group">
    <p class="col-sm-3 control-p">登记人</p>
    <div class="col-sm-8"><input type="text" class="form-control" value="<?php echo $Registrant; ?>" disabled></div>
  </div><br>

  <div class="form-group">
    <p class="col-sm-3 control-p">账单名称</p>
    <div class="col-sm-8"><input type="text" class="form-control" name="Name" value="<?php echo $Name; ?>" autocomplete="off"></div>
  </div>
  <div class="form-group">
    <p class="col-sm-3 control-p">账单内容</p>
    <div class="col-sm-8"><input type="text" class="form-control" name="Content" value="<?php echo $Content; ?>" autocomplete="off"></div>
  </div>
  <div class="form-group">
    <p class="col-sm-3 control-p">此单支出</p>
    <div class="col-sm-8"><input type="text" class="form-control" name="Cost" value="<?php echo $Cost; ?>" autocomplete="off"></div>
  </div>
  <div class="form-group">
    <p class="col-sm-3 control-p">此单收入</p>
    <div class="col-sm-8"><input type="text" class="form-control" name="Income" value="<?php echo $Income; ?>" autocomplete="off"></div>
  </div>

  <br><br>
  <input type="submit" class="btn btn-primary" value="确认修改" style="width:100%">
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
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
//No Data
if($BillList[1]==0){
  header("Location: toBillList.php?sutk=$SUtoken");
}
//Get Detail
$Name=$BillList[0][0]["BillName"];
$Content=$BillList[0][0]["Content"];
$Income=$BillList[0][0]["Income"];
$Cost=$BillList[0][0]["Cost"];
$Registrant=$BillList[0][0]["Registrant"];

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
  <link href="/Admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.bootcss.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.svg" rel="stylesheet">
  
  <style>
  a{color:#4caf50;}
  a:hover{color:#4fb4f7;transition: 0.6s;}
  </style>
</head>

<body>
<?php include("../Includes/shownav.php"); ?>
<center><h3>编辑账单</h3><hr>
<form method="post">
  账单登记人：<?php echo $Registrant; ?><br>
  账单名称：<input type="text" name="Name" value="<?php echo $Name; ?>" autocomplete="off"><br>
  账单内容：<input type="text" name="Content" value="<?php echo $Content;?>" autocomplete="off"><br>
  此单支出：<input type="text" name="Cost" value="<?php echo $Cost; ?>" autocomplete="off"><br>
  此单收入：<input type="text" name="Income" value="<?php echo $Income; ?>" autocomplete="off">
  <br><br>
  <input type="submit" class="btn btn-primary" value="确 认 修 改" style="width:80%">
</form>
<hr> 
</body>

<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</html>
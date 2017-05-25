<?php
require_once("../Includes/CheckLog.php");
CheckPurv("B");

$flag=true;
require_once("../Includes/to_pdo.php");
$id=$_GET['billid'];
$BillList=PDOQuery($dbcon,"SELECT * FROM bill_list WHERE Billid=?",[$id],[PDO::PARAM_STR]);
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 账单详细内容</title>
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
<table class="table table-hover table-striped" style="border-radius: 5px; border-collapse: separate;">
<tr>
  <th>账单ID</th>
  <td><?php echo $BillList[0][0]['billid']; ?></td>
</tr><tr>
  <th>账单名称</th>
  <td><?php echo $BillList[0][0]['BillName']; ?></td>
</tr><tr>
  <th>账单内容</th>
  <td><?php echo $BillList[0][0]['Content']; ?></td>
</tr><tr>
  <th>支出</th>
  <td><?php echo $BillList[0][0]['Cost']; ?></td>
</tr><tr>
  <th>收入</th>
  <td><?php echo $BillList[0][0]['Income']; ?></td>
</tr><tr>
  <th>账单登记人</th>
  <td><?php echo $BillList[0][0]['Registrant']; ?></td>
</tr>
</table>
<hr><center>
  <button class="btn btn-info" onclick='window.location.href="toEditBillList.php?billid=<?php echo $id; ?>&sutk=<?php echo $SUtoken; ?>"'>编辑此账单</button>&#12288;
  <button class="btn btn-danger" onclick="toDelBill('<?php echo $id; ?>','<?php echo $SUtoken; ?>')">删除此账单</button>&#12288;
  <button class="btn btn-default" onclick='window.location.href="toBillList.php?sutk=<?php echo $SUtoken; ?>"'>返回主页</button>
</center><hr>
</body>

<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script>

function toDelBill(billid,token){
 URL = "toDelBillList.php?billid=" + billid + "&sutk=" + token;
 if(confirm("确定要删除吗？")){
  window.location.href = URL;
 }else{
  return;
 }
}

</script>
</html>
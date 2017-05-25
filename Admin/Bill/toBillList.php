<?php
require_once("../Includes/CheckLog.php");
CheckPurv("B");

$flag=true;
require_once("../Includes/to_pdo.php");
$list=PDOQuery($dbcon,"SELECT * FROM bill_list",[],[]);
$total=sizeof($list[0]);
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 账目列表</title>
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
  <th>ID</th>
  <th>名称</th>
  <th>支出</th>
  <th>收入</th>
  <th>登记人</th>
  <th>操作</th>
</tr>

<?php
for($i=0;$i<$total;$i++){
$id=$list[0][$i]['billid'];
?>

<tr>
  <td><?php echo $id; ?></td>
  <td><?php echo $list[0][$i]['BillName']; ?></td>
  <td><?php echo $list[0][$i]['Cost']; ?></td>
  <td><?php echo $list[0][$i]['Income']; ?></td>
  <td><?php echo $list[0][$i]['Registrant']; ?></td>
  <td><a href='toBillDetail.php?billid=<?php echo $id; ?>&sutk=<?php echo $SUtoken; ?>' class='btn-link'> 详情</a> <a href='toEditBillList.php?billid=<?php echo $id; ?>&sutk=<?php echo $SUtoken; ?>' class='btn-link'> 修改</a> <a href='toDelBillList.php?billid=<?php echo $id; ?>&sutk=<?php echo $SUtoken; ?>' class='btn-link'> 删除</a></td>
</tr>
<?php } ?>

</table>
</body>

<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</html>
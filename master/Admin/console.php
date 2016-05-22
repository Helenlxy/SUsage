<?php
session_start();
require_once("Includes/CheckLog.php");
$flag=true;
require_once("Includes/to_pdo.php");

$Tasks=PDOQuery($dbcon,"SELECT * FROM task_list",[],[]);
$total=sizeof($Tasks[0]);
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 首页</title>
  
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.bootcss.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.svg" rel="stylesheet">
  
  <style>
  a{color:#4caf50;}
  a:hover{color:#4fb4f7;transition: 0.6s;}
  </style>
</head>

<body style="font-family:Microsoft YaHei;">
<?php include("Includes/shownav.php"); ?>
<table class="table table-hover table-striped" style="border-radius:50px;">
<tr>
  <th>UID</th>
  <th>发布者</th>
  <th>发布者组别</th>
  <th>接收者组别</th>
  <th>标题</th>
  <th>内容</th>
  <th>操作</th>
</tr>

<?php
for($i=0;$i<$total;$i++){
  $id=$Tasks[0][$i]['id'];
  echo "<tr>";
  echo "<td>".$id."</td>";
  echo "<td>".$Tasks[0][$i]['pubman']."</td>";
  echo "<td>".$Tasks[0][$i]['pubgroup']."</td>";
  echo "<td>".$Tasks[0][$i]['regroup']."</td>";
  echo "<td>".$Tasks[0][$i]['topic']."</td>";
  echo "<td>".$Tasks[0][$i]['ct']."</td>";
  echo "<td><a href='Task/toEdit.php?id=$id' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-edit'></span> 修改</a></td>";
  echo "</tr>";
}
?>
</table>
</body>

<!-- JavaScript -->
<script src="/SUsage/Admin/Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="/SUsage/Admin/js/bootstrap.js"></script>
</html>

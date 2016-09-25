<?php
require_once("../Includes/CheckLog.php");
$flag=true;
require_once("../Includes/to_pdo.php");
$Tasks=PDOQuery($dbcon,"SELECT * FROM task_list ORDER BY Taskid DESC",[],[]);
$total=sizeof($Tasks[0]);
$Page=isset($_GET['Page'])?$_GET['Page']:"1";
$PageSize=isset($_GET['PageSize'])?$_GET['PageSize']:"20";
$TotalPage=ceil($total/$PageSize);

if($Page>$TotalPage){
 header("Location: toList.php?sutk=$SUtoken");
}

$Begin=($Page-1)*$PageSize;
$Limit=$Page*$PageSize;

if($Limit>$total) $Limit=$total;
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 任务管理</title>
  
  <!-- Bootstrap -->
  <link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.bootcss.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.svg" rel="stylesheet">
  <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <style>
  @media(max-width: 500px){
    .uid{
      display: none;
    }
    .cts{
      max-width:32%;
    }
  }
  a{color:#4caf50;}
  a:hover{color:#4fb4f7;transition: 0.6s;}
  </style>
</head>

<body>
<?php include("../Includes/shownav.php"); ?>
<table class="table table-hover table-striped" style="border-radius:50px;">
<tr>
  <th class="uid">UID</th>
  <th>发布者</th>
  <th>发布者组别</th>
  <th>接收者组别</th>
  <th class="cts">内容</th>
  <th>操作</th>
</tr>

<?php
for($i=$Begin;$i<$Limit;$i++){
  $id=$Tasks[0][$i]['Taskid'];
  echo "<tr>";
  echo "<td class='uid'>".$id."</td>";
  echo "<td>".$Tasks[0][$i]['pubman']."</td>";
  echo "<td>".$Tasks[0][$i]['pubdep']."</td>";
  echo "<td>".$Tasks[0][$i]['redep']."</td>";
  echo "<td class='cts'>".strip_tags($Tasks[0][$i]['ct'])."</td>";
  echo "<td><button onclick='toDel($id)' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-edit'></span> 删除</button></td>";
  echo "</tr>";
}
?>
</table>
<center><nav>
 <ul class="pagination"> 
  <?php if($Page-1>0){ ?>
  <li>
   <a href="toList.php?sutk=<?php echo $SUtoken; ?>&Page=<?php echo $Page-1; ?>" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a>
  </li>
  <?php } ?>
  <?php
  for($j=1;$j<=$TotalPage;$j++){
   if($j==$Page){
    echo "<li class='disabled'><a>$j</a></li>";
   }else{
    echo "<li><a href='toList.php?sutk=$SUtoken&Page=$j'>$j</a></li>";
   }
  }
  ?>
  <?php if($Page+1<=$TotalPage){ ?>
  <li>
   <a href="toList.php?sutk=<?php echo $SUtoken; ?>&Page=<?php echo $Page+1; ?>" aria-label="Next"> <span aria-hidden="true">&raquo;</span></a>
  </li>
  <?php } ?>
 </ul>
</nav></center>


</body>

<script>
function toDel(id){
$.ajax({
  type:"post",
  url:"/Admin/Task/toDel.php",
  data:{id:id},
  success:function(got){
    if(got=="1"){
      alert("删除成功！");
      history.go(0);
    }else if(got=="2"){
      alert("删除失败！网络连接错误，请联系电脑部APP组成员！");
      history.go(0);
    }else{alert("删除失败！错误码："+got);}
  },
  error:function(e){alert(e);},
});
}
</script>

<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</html>
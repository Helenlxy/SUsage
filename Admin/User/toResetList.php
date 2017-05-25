<?php
require_once("../Includes/CheckLog.php");
CheckPurv("U_P");

$flag=true;
require_once("../Includes/to_pdo.php");
$list=PDOQuery($dbcon,"SELECT * FROM sys_user",[],[]);
$total=sizeof($list[0]);
$Page=isset($_GET['Page'])?$_GET['Page']:"1";
$PageSize=isset($_GET['PageSize'])?$_GET['PageSize']:"20";
$TotalPage=ceil($total/$PageSize);

if($Page>$TotalPage){
 header("Location: toResetList.php?sutk=$SUtoken");
}

$Begin=($Page-1)*$PageSize;
$Limit=$Page*$PageSize;

if($Limit>$total) $Limit=$total;
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 用户管理</title>
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
  <th>用户名</th>
  <th>姓名</th>
  <th>部门</th>
  <th>操作</th>
</tr>
<?php
  for($i=$Begin;$i<$Limit;$i++){
    $uid=$list[0][$i]['id'];
    $name=$list[0][$i]['tname'];
    echo "<tr>";
    echo "<td>".$list[0][$i]['stuid']."</td>";
    echo "<td>".$name."</td>";
    echo "<td>".$list[0][$i]['dep']."</td>";
    echo "<td><button onclick='toReset($uid)' class='btn-link'>重置密码</a></td>";
    echo "</tr>";
  }
?>
</table>

<center><nav>
 <ul class="pagination"> 
  <?php if($Page-1>0){ ?>
  <li>
   <a href="toResetList.php?sutk=<?php echo $SUtoken; ?>&Page=<?php echo $Page-1; ?>" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a>
  </li>
  <?php } ?>
  <?php
  for($j=1;$j<=$TotalPage;$j++){
   if($j==$Page){
    echo "<li class='disabled'><a>$j</a></li>";
   }else{
    echo "<li><a href='toResetList.php?sutk=$SUtoken&Page=$j'>$j</a></li>";
   }
  }
  ?>
  <?php if($Page+1<=$TotalPage){ ?>
  <li>
   <a href="toResetList.php?sutk=<?php echo $SUtoken; ?>&Page=<?php echo $Page+1; ?>" aria-label="Next"> <span aria-hidden="true">&raquo;</span></a>
  </li>
  <?php } ?>
 </ul>
</nav></center>


</body>

<script>

//Reset Password (Ajax)
function toReset(uid){
$.ajax({
  type:"post",
  url:"toResetPW.php",
  data:{uid:uid},
  success:function(got){
    if(got.substr(1,1)=="1"){
      pw = got.substr(3);
      alert("重置成功！重置后的密码为："+pw);
    }else{
      alert("重置失败！请联系电脑部APP组！\n\n"+got);
    }
  },
  error:function(e){alert("重置失败！请联系电脑部！");},
  });
}
</script>

<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</html>
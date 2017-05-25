<?php
require_once("../Includes/CheckLog.php");

$DepArr=array("主席团","内务部","公关部","宣传部","文娱部","电视台","电脑部","广播站","社联","学术部","体育部");

$sql="SELECT * FROM sys_user";

$UF=@$_GET['UserFilter'];
$DF=@$_GET['DepFilter'];

if(isset($_GET['DepFilter']) && $_GET['DepFilter']){
 $sql.=" WHERE dep LIKE '%{$DF}%'";
}

if(isset($_GET['UserFilter']) && $_GET['UserFilter']){
 $sql.=" WHERE stuid='{$UF}'";
}

$flag=true;
require_once("../Includes/to_pdo.php");
$list=PDOQuery($dbcon,$sql,[],[]);
$total=sizeof($list[0]);
$Page=isset($_GET['Page'])?$_GET['Page']:"1";
$PageSize=isset($_GET['PageSize'])?$_GET['PageSize']:"20";
$TotalPage=ceil($total/$PageSize);

if($UF && $total==0){
 echo "<script>alert('无此用户名的用户');</script>";
 header("Location: toList.php?sutk=$SUtoken");
}

if($Page>$TotalPage && !$UF){
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
<center>
  <h2>用户列表</h2>
  <h3><?php echo "第{$Page}页 / 共{$TotalPage}页（{$total}个用户）"; ?></h3>
  
<hr>
  <select id="DepFilter" onchange="toDepFilter(this.value);">

  <?php
  if($DF==""){
   echo '<option selected="TRUE" disabled>---请选择筛选部门---</option>';
  }else{
   $key=array_search($DF,$DepArr);
   unset($DepArr[$key]);
   echo '<option selected="TRUE" disabled>'.$DF.'</option>';
  }

  foreach($DepArr as $v){
   echo '<option value="'.$v.'">'.$v.'</option>';
  }
  ?>

  </select>
  <input onchange="toUserNameFilter(this.value)" placeholder="输入用户名，回车走起">
</center>

<hr>

<table class="table table-hover table-striped" style="border-radius: 5px; border-collapse: separate;">
<tr>
  <th>用户名</th>
  <th>姓名</th>
  <th>手机</th>
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
    echo "<td>".$list[0][$i]['Phone']."</td>";
    echo "<td>".$list[0][$i]['dep']."</td>";
    echo "<td><a href='toEdit.php?uid=$uid&name=$name&sutk=$SUtoken' class='btn-link'><span class='glyphicon glyphicon-edit'></span> 修改</a></td>";
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
var Token = "<?php echo $SUtoken; ?>";

function toDepFilter(DepName){
 window.location.href="toList.php?DepFilter="+DepName+"&sutk="+Token;
}


function toUserNameFilter(UserName){
 window.location.href="toList.php?UserFilter="+UserName+"&sutk="+Token;
}

</script>


<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</html>
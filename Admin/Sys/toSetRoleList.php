<?php

require_once("../Includes/CheckLog.php");

CheckPurv("U_R");


$DepArr=array("主席团","内务部","公关部","宣传部","文娱部","电视台","电脑部","广播站","社联","学术部","体育部");
$sql="SELECT * FROM sys_user";
$DF="";


if(isset($_GET['DepFilter']) && $_GET['DepFilter']){
 $DF=$_GET['DepFilter'];
 $sql.=" WHERE dep LIKE '%{$DF}%'";
}
 
$flag=true;

require_once("../Includes/to_pdo.php");

$list=PDOQuery($dbcon,$sql,[],[]);

$total=sizeof($list[0]);

$Page=isset($_GET['Page'])?$_GET['Page']:"1";

$PageSize=isset($_GET['PageSize'])?$_GET['PageSize']:"20";

$TotalPage=ceil($total/$PageSize);



if($Page>$TotalPage){

 header("Location: toSetRoleList.php?sutk=$SUtoken");

}



$Begin=($Page-1)*$PageSize;

$Limit=$Page*$PageSize;



if($Limit>$total) $Limit=$total;

?>



<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>SUsage 管理中心 :: 用户角色管理</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

  <h2>用户角色分配</h2>

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
</center>
<hr>
<table class="table table-hover table-striped" style="border-radius: 5px; border-collapse: separate;">

<tr>

  <th>真名</th>

  <th>用户名</th>

  <th>部门</th>

  <th>将角色设置为</th>

</tr>

<?php

  for($i=$Begin;$i<$Limit;$i++){

    $uid=$list[0][$i]['id'];

    $name=$list[0][$i]['tname'];

    

    $pur=PDOQuery($dbcon,"SELECT * FROM sys_user_purv WHERE Userid=?",[$uid],[PDO::PARAM_STR]);



    if($pur[0][0]['isMaster']=="1")

    {$setM=0;$nameM=" 非组长";}

    else{$setM=1;$nameM=" 组长 ";}

    

    if($pur[0][0]['isAdmin']=="1")

    {$setA=0;$nameA=" 非管理员";}

    else{$setA=1;$nameA=" 管理员 ";}

    

    if($pur[0][0]['isSuper']=="1")

    {$setS=0;$nameS=" 非超管";}

    else{$setS=1;$nameS=" 超管 ";}

    

    echo "<tr>";

    echo "<td>".$name."</td>";

    echo "<td>".$list[0][$i]['stuid']."</td>";

    echo "<td>".$list[0][$i]['dep']."</td>";

    echo "<td><a href='toSetRole.php?type=Master&uid=$uid&set=$setM&sutk=$SUtoken' class='btn-link'></span>$nameM</a>";

    

    if($_SESSION['isSuper']=="1"){

    echo " <a href='toSetRole.php?type=Admin&uid=$uid&set=$setA&sutk=$SUtoken' class='btn-link'>$nameA</a>";

    echo " <a href='toSetRole.php?type=Super&uid=$uid&set=$setS&sutk=$SUtoken' class='btn-link'>$nameS</a><br>";

    }

    echo "</td>";

    echo "</tr>";

  }

?>

</table>

<center><nav>

 <ul class="pagination"> 

  <?php if($Page-1>0){ ?>

  <li>

   <a href="toSetRoleList.php?sutk=<?php echo $SUtoken; ?>&Page=<?php echo $Page-1; ?>" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a>

  </li>

  <?php } ?>

  <?php

  for($j=1;$j<=$TotalPage;$j++){

   if($j==$Page){

    echo "<li class='disabled'><a>$j</a></li>";

   }else{

    echo "<li><a href='toSetRoleList.php?sutk=$SUtoken&Page=$j'>$j</a></li>";

   }

  }

  ?>

  <?php if($Page+1<=$TotalPage){ ?>

  <li>

   <a href="toSetRoleList.php?sutk=<?php echo $SUtoken; ?>&Page=<?php echo $Page+1; ?>" aria-label="Next"> <span aria-hidden="true">&raquo;</span></a>

  </li>

  <?php } ?>

 </ul>

</nav></center>

</body>



<script>
function toDepFilter(DepName){
 Token = "<?php echo $SUtoken; ?>";
 window.location.href="toSetRoleList.php?DepFilter="+DepName+"&sutk="+Token;
}
</script>

<script src="../Includes/footer.js"></script>

<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>

<script src="../js/bootstrap.js"></script>

</html>
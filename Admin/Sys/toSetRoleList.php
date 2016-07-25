<?php
require_once("../Includes/CheckLog.php");

$flag=true;
require_once("../Includes/to_pdo.php");
$list=PDOQuery($dbcon,"SELECT * FROM sys_user",[],[]);
$total=sizeof($list[0]);

?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 用户角色管理</title>
  
  <!-- Bootstrap -->
  <link href="/SUsage/Admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.bootcss.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.svg" rel="stylesheet">
  
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
  <th>真实姓名</th>
  <th>部门</th>
  <th>职位</th>
  <th>将角色设置为</th>
</tr>
<?php
  //In SUsage2 will use Ajax
  for($i=0;$i<$total;$i++){
    $uid=$list[0][$i]['id'];
    $name=$list[0][$i]['tname'];
    
    if($list[0][$i]['isMaster']=="1")
    {$setM=0;$nameM=" 非组长";}
    else{$setM=1;$nameM=" 组长 ";}
    
    if($list[0][$i]['isAdmin']=="1")
    {$setA=0;$nameA=" 非管理员";}
    else{$setA=1;$nameA=" 管理员 ";}
    
    if($list[0][$i]['isSuper']=="1")
    {$setS=0;$nameS=" 非超管";}
    else{$setS=1;$nameS=" 超管 ";}
    
    //Make Table -Begin
    echo "<tr>";
    echo "<td>".$name."</td>";
    echo "<td>".$list[0][$i]['stuid']."</td>";
    echo "<td>".$list[0][$i]['dep']."</td>";
    echo "<td>".$list[0][$i]['job']."</td>";
    echo "<td><a href='toSetRole.php?type=Master&uid=$uid&set=$setM&sutk=$SUtoken' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-edit'></span>$nameM</a>";
    
    if($_SESSION['isSuper']=="1"){
    echo " <a href='toSetRole.php?type=Admin&uid=$uid&set=$setA&sutk=$SUtoken' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-edit'></span>$nameA</a>";
    echo " <a href='toSetRole.php?type=Super&uid=$uid&set=$setS&sutk=$SUtoken' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-edit'></span>$nameS</a><br>";
    }
    echo "</td>";
    echo "</tr>";
    //Make Table -End
    
  }
?>
</table>
</body>

<!-- JavaScript -->
<script src="/SUsage/Admin/Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="/SUsage/Admin/js/bootstrap.js"></script>
</html>
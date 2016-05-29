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
  <title>SUsage 管理中心 :: 用户管理</title>
  
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
  <th>姓名</th>
  <th>部门</th>
  <th>组别</th>
  <th>职位</th>
  <th>激活状态</th>
  <th>操作</th>
</tr>
<?php
  for($i=0;$i<$total;$i++){
    $uid=$list[0][$i]['id'];
    $name=$list[0][$i]['tname'];
    echo "<tr>";
    echo "<td>".$list[0][$i]['stuid']."</td>";
    echo "<td>".$name."</td>";
    echo "<td>".$list[0][$i]['dep']."</td>";
    echo "<td>".$list[0][$i]['depgroup']."</td>";
    echo "<td>".$list[0][$i]['job']."</td>";
    echo "<td>".$list[0][$i]['status']."</td>";
    echo "<td><button onclick='toReset($uid)' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-edit'></span> 重置密码</a></td>";
    echo "</tr>";
  }
?>
</table>
</body>

<script>

//Reset Password (Ajax)
function toReset(uid){
	$.ajax({
  type:"post",
  url:"/SUsage/Admin/User/toResetPW.php",
  data:{uid:uid},
  success:function(got){
    if(got.substr(0,1)==1){
    	pw=got.substr(2);
    	//Fix UI (Use Modal)
    	alert("重置成功！重置后的密码为："+pw);
    }

    else if(got.substr(0,1)==2){
    	alert("网络连接失败！请联系电脑部！");
    }
    
    else{alert("重置失败！请联系电脑部！");}
  },
  error:function(e){alert("重置失败！请联系电脑部！");},
  });
}
</script>
<!-- JavaScript -->
<script src="/SUsage/Admin/Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="/SUsage/Admin/js/bootstrap.js"></script>
</html>
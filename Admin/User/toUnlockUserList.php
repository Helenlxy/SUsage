<?php
require_once("../Includes/CheckLog.php");

if(GetSess("isRoot")!="1"){
 header("Location: toList.php?sutk=$SUtoken");
}

$flag=true;
require_once("../Includes/to_pdo.php");
$list=PDOQuery($dbcon,"SELECT * FROM sys_user WHERE isLock=?",["1"],[PDO::PARAM_STR]);
$total=sizeof($list[0]);
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 用户解锁</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <hr>
  <button class="btn btn-info" style="width:90%" onclick="toBaoDian();">如何解锁（戳入解锁宝典）</button>
  <hr>
</center>
<table class="table table-hover table-striped" style="border-radius: 5px; border-collapse: separate;">
<tr>
  <th>用户名</th>
  <th>姓名</th>
  <th>部门</th>
  <th>操作</th>
</tr>
<?php
if($total==0){
 echo "<tr><td colspan='4'><font color='red'><b><center>暂无被锁定用户</center></b></font></td></tr>";
}

for($i=0;$i<$total;$i++){
 $uid=$list[0][$i]['id'];
 $name=$list[0][$i]['tname'];
 echo "<tr>";
 echo "<td>".$list[0][$i]['stuid']."</td>";
 echo "<td>".$name."</td>";
 echo "<td>".$list[0][$i]['dep']."</td>";   
 echo '<td><button onclick="toUnlockUser('."'".$uid."'".')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> 解锁</button></td>';
 echo "</tr>";
}
?>
</table>
</body>

<script>
function toBaoDian(){
 token = "<?php echo $SUtoken; ?>";
 url = "HowtoUnlockUser.php?sutk="+token;
 window.open(url);
}

function toUnlockUser(uid){
if(confirm("确认已经按照宝典步骤校验对方身份了吗？\n\n确认完毕，请按“确认”")){
 $.ajax({
  url:"DPtoUnlockUser.php",
  type:"POST",
  data:{Userid:uid},
  error:function(e){alert("解锁失败");},
  success:function(s){
   if(s==1){
    alert("解锁成功");
    location.reload();
   }else{
    alert("错误的解锁\n\n请提交错误码："+s);
   }
  }
 });
}
}
</script>

<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</html>
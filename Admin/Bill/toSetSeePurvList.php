<?php
require_once("../Includes/CheckLog.php");
CheckPurv("B");

$flag=true;
require_once("../Includes/to_pdo.php");
$list=PDOQuery($dbcon,"SELECT * FROM sys_user",[],[]);
$total=sizeof($list[0]);
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 分配查看权限</title>
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
<hr>
<div style="color:#546E7A;font-size:20px;font-weight:bold;font-family:微软雅黑;padding:0 20px 0 20px;">
  <input type="CheckBox" onclick="CheckAll()" id="Checking"> 全选
</div>

<hr>

<div style="color:#0085fc;font-size:20px;font-weight:bold;font-family:微软雅黑;padding:0 20px 0 20px;">
<?php
for($i=0;$i<$total;$i++){
  $uid=$list[0][$i]['id'];
  $tname=$list[0][$i]['tname'];
  $tnameLeng=strlen($tname);
  if($tnameLeng<9)$tname.="&#12288;";
  if($tnameLeng<12)$tname.="&#12288;";
  $dep=$list[0][$i]['dep'];
  $pur=PDOQuery($dbcon,"SELECT * FROM sys_user_purv WHERE Userid=?",[$uid],[PDO::PARAM_STR]);
  if($pur[0][0]['CanSee']=="1"){
?>
  <input type="checkbox" name="User[]" value="<?php echo $uid; ?>" onclick="GetSelectUser();" checked="true"> <?php echo $tname."<font color='#5bc0de'>（{$dep}）</font>"; ?><br>
  <?php }else{ ?>
  <input type="checkbox" name="User[]" value="<?php echo $uid; ?>" onclick="GetSelectUser();"> <?php echo $tname."<font color='#5bc0de'>（{$dep}）</font>"; ?><br>
  <?php } } ?>
</div>

<hr>
<center><button onclick="ChangePurv();" class="btn btn-info" style="width:40%">确认分配权限</button></center>
<hr>

<script>
var AllUser = document.getElementsByName("User[]");
var ids = "";

function CheckAll(){
var Checking = document.getElementById("Checking");
  if(Checking.checked){
    for(i=0,j=AllUser.length;i<j;i++){
      AllUser[i].checked=true;
    }
  }else{
    for(i=0,j=AllUser.length;i<j;i++){
      AllUser[i].checked=false;
    }
  }
}

function GetSelectUser(){
  ids = "";
  for(i=0,j=AllUser.length;i<j;i++){
    if(AllUser[i].checked){
      ids += AllUser[i].value;
      ids += ",";
    }
  }
  //去除最后一个逗号
  total = ids.length;
  ids = ids.substr(0,total-1);
}


function ChangePurv(){
if(ids==""){
  alert("未选中任何用户 或 未做任何修改！");return;
}
token = "<?php echo $SUtoken; ?>";
$.ajax({
  url:"toSetSeePurv.php?sutk="+token,
  type:"POST",
  data:{UserIds:ids},
  error:function(e){
    e=eval(e);
    alert("未知错误！\n错误码："+e.status+"\n状态码："+e.readyState);
  },
  success:function(g){
    if(g.substr(0,6)=="<html>"){
      alert("token验证失败！");
    }else if(g>0){
      alert("恭喜您！分配权限成功！");
      location.reload();
    }else if(g=="C"){
      alert("[错误码C]权限分配失败！请提交错误码至电脑部App组！");
    }else{
      alert("[错误码"+g+"]权限分配失败！请提交错误码至电脑部App组！");
    }
  }
});
}
</script>
</body>

<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</html>
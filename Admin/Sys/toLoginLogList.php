<?php
require_once("../Includes/CheckLog.php");
CheckPurv("L_L");

$sql="SELECT * FROM sys_login_log";

$FT_BeginDate=@$_GET['BeginDate'];
$FT_EndDate=@$_GET['EndDate'];
if($FT_BeginDate != "" && $FT_EndDate != ""){
 $sql.=" WHERE LoginTime >= '{$FT_BeginDate}' AND LoginTime <= '{$FT_EndDate}'";
}

$flag=true;
require_once("../Includes/to_pdo.php");
$list=PDOQuery($dbcon,$sql,[],[]);
$total=sizeof($list[0]);

$Page=isset($_GET['Page'])?$_GET['Page']:"1";
$PageSize=isset($_GET['PageSize'])?$_GET['PageSize']:"20";
$TotalPage=ceil($total/$PageSize);

if($Page>$TotalPage){
 header("Location: toLoginLogList.php?sutk=$SUtoken");
}

$Begin=($Page-1)*$PageSize;
$Limit=$Page*$PageSize;

if($Limit>$total) $Limit=$total;

function LoginStatus($Status){
switch($Status){
 case "0":
  $echo="失败";break;
 case "1":
  $echo="成功";break;
 case "M":
  $echo="后台";break;
 case "U":
  $echo="无名";break;
 case "L":
  $echo="封号";break;
 case "6":
  $echo="侵入";break;
 default:
  $echo=$Status;break;
}
return $echo;
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 查看登录记录</title>
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
  <h2>用户登录记录</h2>
  <h3><?php echo "第{$Page}页 / 共{$TotalPage}页（{$total}条记录）"; ?></h3>
  <?php if(GetSess("isRoot")=="1"){ ?>
  <hr>
  <button class="btn btn-danger" style="width:90%" onclick="Del();">删除所有记录</button><br><br>
  <?php } ?>
  时间段筛选：
   <input ID="B_M" NAME="B_M" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="2" size="2" oninput="TurnNextInput(1,this.value)">月
   <input ID="B_D" NAME="B_D" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="2" size="2" oninput="TurnNextInput(2,this.value)">日
   <input ID="B_H" NAME="B_H" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="2" size="2" oninput="TurnNextInput(3,this.value)">时 ~ 
   <input ID="E_M" NAME="E_M" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="2" size="2" oninput="TurnNextInput(4,this.value)">月
   <input ID="E_D" NAME="E_D" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="2" size="2" oninput="TurnNextInput(5,this.value)">日
   <input ID="E_H" NAME="E_H" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="2" size="2" oninput="toTimeFilter()">时

</center>
<hr>

<table class="table table-hover table-striped" style="border-radius: 5px; border-collapse: separate;">
<tr>
  <th>用户名</th>
  <th>状态</th>
  <th>IP</th>
  <th>时间</th>
</tr>
<?php
  for($i=$Begin;$i<$Limit;$i++){
    echo "<tr>";
    echo "<td>".$list[0][$i]['UserName']."</td>";
    echo "<td>".LoginStatus($list[0][$i]['isSuccess'])."</td>";
    echo "<td>".$list[0][$i]['IPAddress']."</td>";
    echo "<td>".$list[0][$i]['LoginTime']."</td>";
    echo "</tr>";
  }
?>
</table>

<center><nav>
 <ul class="pagination"> 
  <?php if($Page-1>0){ ?>
  <li>
   <a href="toLoginLogList.php?sutk=<?php echo $SUtoken; ?>&Page=<?php echo $Page-1; ?>" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a>
  </li>
  <?php } ?>
  <?php
  for($j=1;$j<=$TotalPage;$j++){
   if($j==$Page){
    echo "<li class='disabled'><a>$j</a></li>";
   }else{
    echo "<li><a href='toLoginLogList.php?sutk=$SUtoken&Page=$j'>$j</a></li>";
   }
  }
  ?>
  <?php if($Page+1<=$TotalPage){ ?>
  <li>
   <a href="toLoginLogList.php?sutk=<?php echo $SUtoken; ?>&Page=<?php echo $Page+1; ?>" aria-label="Next"> <span aria-hidden="true">&raquo;</span></a>
  </li>
  <?php } ?>
 </ul>
</nav></center>
</body>

<script>
var TOKEN = "<?php echo $SUtoken; ?>";
var InputID=["B_M","B_D","B_H","E_M","E_D","E_H"];
function Del(){
 if(confirm("确认删除所有记录吗？")==true){
  window.location.href='toDelLoginLog.php?sutk='+TOKEN;
 }else{return;}
}

function TurnNextInput(NextID,value){
 if(value.length == 2 && value < 60){
  $('#'+InputID[NextID])[0].focus();
 }else if(value >= 60){
  alert("请准确输入时间段信息！");
  NowID=NextID-1;
  $("#"+InputID[NowID]).val("");
 }else{
  return;
 }
}

function toTimeFilter(){
 BeginMonth = $("#B_M").val();
 BeginDay = $("#B_D").val();
 BeginHour = $("#B_H").val();
 EndMonth = $("#E_M").val();
 EndDay = $("#E_D").val();
 EndHour = $("#E_H").val();
 BeginDate = "2016-"+BeginMonth+"-"+BeginDay+" "+BeginHour+":00:00";
 EndDate = "2016-"+EndMonth+"-"+EndDay+" "+EndHour+":00:00";
 URL = "toLoginLogList.php?BeginDate="+BeginDate+"&EndDate="+EndDate+"&sutk="+TOKEN;
 window.location.href = URL;
}
</script>

<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</html>
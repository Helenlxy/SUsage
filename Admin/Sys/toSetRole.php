<?php
require_once("../Includes/CheckLog.php");
$uid=$_GET['uid'];
$set=$_GET['set'];
$type=$_GET['type'];

$str='{"1":["0","0","0","组员"],"2":["1","0","0","组长"],"3":["1","1","0","管理员"],"4":["0","1","0","管理员"],"5":["1","1","1","超级管理员"],"6":["0","1","1","超级管理员"]}';
$array=json_decode($str,true);

$flag=true;
require_once("../Includes/to_pdo.php");

if($set=="1" && $type=="Super"){
  $rs=PDOQuery($dbcon,"UPDATE sys_user_purv SET isSuper='1',isAdmin='1' WHERE Userid=?",[$uid],[PDO::PARAM_STR]);
}else if($set=="0" && $type=="Admin"){
  $rs=PDOQuery($dbcon,"UPDATE sys_user_purv SET isAdmin='0',isSuper='0' WHERE Userid=?",[$uid],[PDO::PARAM_STR]);
}else{
  $rs=PDOQuery($dbcon,"UPDATE sys_user_purv SET is$type=? WHERE Userid=?",[$set,$uid],[PDO::PARAM_STR,PDO::PARAM_STR]);
}

$newpur=PDOQuery($dbcon,"SELECT * FROM sys_user_purv WHERE Userid=?",[$uid],[PDO::PARAM_STR]);
$M=$newpur[0][0]["isMaster"];
$A=$newpur[0][0]["isAdmin"];
$S=$newpur[0][0]["isSuper"];
$iq=PDOQuery($dbcon,"SELECT * FROM sys_user WHERE id=?",[$uid],[PDO::PARAM_STR]);

for($i=1;$i<=sizeof($array);$i++){
  $JM=$array[$i][0];
  $JA=$array[$i][1];
  $JS=$array[$i][2];
  $JJ=$array[$i][3];
  if($M==$JM && $A==$JA && $S==$JS){
    $job=$JJ;
  }else{
    echo $i.".Matching Failure.<br>";
  }
}

if($job==$iq[0][0]["job"]){
  $rs2[1]=1;
}else{
  $rs2=PDOQuery($dbcon,"UPDATE sys_user SET job=? WHERE id=?",[$job,$uid],[PDO::PARAM_STR,PDO::PARAM_STR]);
}
if($rs2[1]==1){ ?>
<script>
alert("恭喜你！修改成功！\n——————————————\n修改对象：<?php echo $iq[0][0]["tname"];?>\n所在部门：<?php echo $iq[0][0]["dep"];?>\n当前职称：<?php echo $job;?>");
history.go(-1);
</script>
<?php
}else{
$error=$rs[1].$rs2[1];
echo "<script>alert('用户角色修改失败！请联系电脑部'+$error);</script>";}
?>
<?php
require_once("../Includes/CheckLog.php");
$uid=(int)$_GET['uid'];
$set=$_GET['set'];
$type=$_GET['type'];

$flag=true;
require_once("../Includes/to_pdo.php");
$iq=PDOQuery($dbcon,"SELECT * FROM sys_user WHERE id=?",[$uid],[PDO::PARAM_INT]);
$isM=$iq[0][0]["isMaster"];
$isA=$iq[0][0]["isAdmin"];
$isS=$iq[0][0]["isSuper"];

switch($type){
  case "Master":
    if($isS=="0" && $isA=="0" && $set=="1"){$job="组长";}
    else if($isS=="1"){$job="超级管理员";}
    else if($isS=="0" && $isA=="1"){$job="管理员";}
    else{$job="组员";}
    break;
    
  case "Admin":
    if($isS=="1"){$job="超级管理员";}
    else if($set=="1"){$job="管理员";}
    else if($isS=="0" && $set=="0"){
      if($isM=="0") $job="组员";
      if($isM=="1") $job="组长";
    }
    else{$job="管理员";}
    break;
    
  case "Super":
    $job="超级管理员";
    break;
}

if(isset($job)){
  $rs=PDOQuery($dbcon,"UPDATE sys_user SET is$type=?,job=? WHERE id=?",[$set,$job,$uid],[PDO::PARAM_STR,PDO::PARAM_STR,PDO::PARAM_INT]);
}

else{
  $rs=PDOQuery($dbcon,"UPDATE sys_user SET is$type=? WHERE id=?",[$set,$uid],[PDO::PARAM_STR,PDO::PARAM_INT]);
}

if($rs[1]==1){ ?>
<script>
alert("恭喜你！修改成功！\n——————————————\n修改对象：<?php echo $iq[0][0]["tname"];?>\n所在部门：<?php echo $iq[0][0]["dep"];?>\n当前角色：<?php echo $job;?>");
history.go(-1);
</script>
<?php
}else{echo "<script>alert('用户角色修改失败！请联系电脑部');</script>";}

?>
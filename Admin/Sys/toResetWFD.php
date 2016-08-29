<?php
$flag=true;
require_once("../Includes/to_pdo.php");
$SuccessCount=0;$Count=0;

$DeleteSQL="DELETE FROM task_complete;";
$DeleteSQL.="ALTER TABLE task_complete auto_increment=1;";
$DeleteRS=PDOQuery($dbcon,$DeleteSQL,[],[]);

$TaskRS=PDOQuery($dbcon,"SELECT * FROM task_list",[],[]);
$total=sizeof($TaskRS[0]);

for($i=0;$i<$total;$i++){
 $Taskid=$TaskRS[0][$i]['Taskid'];
 $Dep=$TaskRS[0][$i]['redep'];
 
 if(strstr($Dep,",")){
  $arrDep=explode(",",$Dep);
 }else{
  $arrDep=array($Dep);
 }
 
 $DepSQL="SELECT * FROM sys_user WHERE";
 for($k=0;$k<sizeof($arrDep);$k++){
  $DepSQL.=" dep LIKE '%{$arrDep[$k]}%' OR";
 }
 
 $DepSQL=substr($DepSQL,0,strlen($DepSQL)-2);
 $DepRS=PDOQuery($dbcon,$DepSQL,[],[]);
 
 $Dtotal=sizeof($DepRS[0]);
 $Count=$Count+$Dtotal;
 
 for($j=0;$j<$Dtotal;$j++){
  $Userid=$DepRS[0][$j]['id'];
  $AddSQL="INSERT INTO task_complete SET Taskid=?, Userid=?";
  $AddRS=PDOQuery($dbcon,$AddSQL,[$Taskid,$Userid],[PDO::PARAM_STR,PDO::PARAM_STR]);
  if($AddRS[1]==1){
   $SuccessCount++;
  }
 }
 
 
}

if($SuccessCount==$Count){
 echo "<script>alert('成功重置 ".$Count." 条！');window.close();</script>";
}else{
 $False=$Count-$SuccessCount;
 echo '<script>alert("重置失败！\n\n成功 '.$SuccessCount.' 条\n失败 '.$False.' 条");window.close();</script>';
}
?>
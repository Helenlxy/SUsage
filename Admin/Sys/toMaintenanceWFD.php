<?php
$flag=true;
require_once("../Includes/to_pdo.php");

$Taskids="";
$ALLSQL="";

$TaskSQL="SELECT * FROM task_list";
$TaskRS=PDOQuery($dbcon,$TaskSQL,[],[]);
$TaskTotal=sizeof($TaskRS[0]);

for($i=0;$i<$TaskTotal;$i++){
 $Taskids.=$TaskRS[0][$i]['Taskid'].",";
}

$Taskids=substr($Taskids,0,strlen($Taskids)-1);
$Taskids=explode(",",$Taskids);


//1
$DelSQL="DELETE FROM task_complete WHERE ";

for($j=0;$j<$TaskTotal;$j++){
 $DelSQL.=" Taskid!='{$Taskids[$j]}' AND";
}
$DelSQL=substr($DelSQL,0,strlen($DelSQL)-3);

$DelRS=PDOQuery($dbcon,$DelSQL,[],[]);
$SuccessDel=$DelRS[1];

//2
for($k=0;$k<$TaskTotal;$k++){
 
 $arrWFDUids=array();
 $arrUserids=array();
 $Dep=$TaskRS[0][$k]['redep'];
 $Taskid=$TaskRS[0][$k]['Taskid'];
 if(strstr($Dep,",")){
  $arrDep=explode(",",$Dep);
 }else{
  $arrDep=array($Dep);
 }
 
 //查找该部门的用户
 $UserSQL="SELECT * FROM sys_user WHERE";
 for($q=0;$q<sizeof($arrDep);$q++){
  $UserSQL.=" dep LIKE '%{$arrDep[$q]}%' OR";
 }
 $UserSQL=substr($UserSQL,0,strlen($UserSQL)-3);
 $UserRS=PDOQuery($dbcon,$UserSQL,[],[]);
 for($n=0;$n<sizeof($UserRS[0]);$n++){
  array_push($arrUserids,$UserRS[0][$n]['id']);
 }
 
 //查询当前任务的所有WFD数据的用户id
 $WFDRS=PDOQuery($dbcon,"SELECT * FROM task_complete WHERE Taskid=?",[$Taskid],[PDO::PARAM_STR]);
 for($m=0;$m<sizeof($WFDRS[0]);$m++){
  array_push($arrWFDUids,$WFDRS[0][$m]['Userid']);
 }

 sort($arrUserids);sort($arrWFDUids);
 
 $arrDiffI=array_diff($arrUserids,$arrWFDUids);
 foreach($arrDiffI as $Value){
  $ALLSQL.="INSERT INTO task_complete SET Taskid='{$Taskid}', Userid='{$Value}';";
 }
 
 $arrDiffD=array_diff($arrWFDUids,$arrUserids);
 foreach($arrDiffD as $Valued){
  $ALLSQL.="DELETE FROM task_complete WHERE Taskid='{$Taskid}' AND Userid='{$Valued}';";
 }
}

//var_dump($ALLSQL);
$ALLRS=PDOQuery($dbcon,$ALLSQL,[],[]);
echo "<script>alert('成功维护WFD数据！');window.close();</script>";
?>
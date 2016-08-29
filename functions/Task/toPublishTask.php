<?php
session_start();
//p:发送 r:接受 sct:搜索 cpt:完成
require_once("../to_sql.php");
require_once("../SO_API.php");
if(GetSess("SU_M")!="1"){toAlertDie("#403","您暂无权限发布任务！");}
$p_man=$_POST['pubman'];
$p_dep=$_POST['pubdep'];
$p_ct=$_POST['ct'];
$r_dep=$_POST['dep'];
$r_dep2=explode(",",$r_dep);
$r_man=array();
$ip=GetIP();

//获取所有需要接收任务的用户
$sct_sql="SELECT * FROM sys_user WHERE";
for($d=0;$d<sizeof($r_dep2);$d++){
  $sct_sql.=" dep='{$r_dep2[$d]}' OR";
}

//去掉SQL语句的最后一段“OR”
$sct_sql=substr($sct_sql,0,strlen($sct_sql)-3);

$sct_query=mysqli_query($conn,$sct_sql);
while($sct_rs=mysqli_fetch_array($sct_query)){
  //往接收用户ID的数组添加元素
  array_push($r_man,$sct_rs['id']);
}

//添加任务
$p_sql="INSERT INTO task_list(pubman,pubdep,redep,ct,ip) VALUES ('{$p_man}','{$p_dep}','{$r_dep}','{$p_ct}','{$ip}')";
$p_rs=mysqli_query($conn,$p_sql);

//获取当前任务在数据库的ID
$p_id_sql="SELECT Taskid FROM task_list ORDER BY Taskid DESC";
$p_id_query=mysqli_query($conn,$p_id_sql);
$p_id=mysqli_fetch_row($p_id_query);
$p_id=$p_id[0];

//记录完成状态
for($r=0;$r<sizeof($r_man);$r++){
  $cpt_sql="INSERT INTO task_complete(Taskid,Userid,isComplete) VALUES ('{$p_id}','{$r_man[$r]}','0')";
  $cpt_query=mysqli_query($conn,$cpt_sql);
}
?>
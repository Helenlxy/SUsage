<?php
$Tid=$_POST['Tid'];
$jsonarr=array();$i=1;
include("../to_sql.php");
$query=mysqli_query($conn,"SELECT * FROM task_complete WHERE Taskid='{$Tid}' AND isComplete='1'");

while($rs=mysqli_fetch_array($query)){
 //获取当前记录的用户ID
 $userid=$rs['Userid'];
 //获取用户资料
 $sql2="SELECT * FROM sys_user WHERE id='{$userid}'";
 $query2=mysqli_query($conn,$sql2);
 $rs2=mysqli_fetch_array($query2);
 //给准备转换为JSON的数组添加元素 
 $jsonarr[$i]['HeadimgURL']=$rs2['headimg'];
 $jsonarr[$i]['TrueName']=$rs2['tname'];
 $i++;
}

$json=json_encode($jsonarr);
echo $json;
?>
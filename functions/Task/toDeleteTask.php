<?php
session_start();
$Tid=@$_POST['Taskid'];
$intTid=(int)$Tid;
if($intTid==0 || $intTid<0){
  echo "0";
}else{
  $Truename=$_SESSION['truename'];
  require_once("../to_sql.php");

  $sql="SELECT * FROM task_list WHERE Taskid='{$Tid}'";
  $query=mysqli_query($conn,$sql);
  $rs=mysqli_fetch_array($query);
  
  if($Truename != $rs['pubman']){
    echo "1";
  }else{
  
    $delsql="DELETE FROM task_list WHERE Taskid='{$Tid}'";
    $delsql2="DELETE FROM task_complete WHERE Taskid='{$Tid}'";
    
    $delrs=mysqli_query($conn,$delsql);
    $delrs2=mysqli_query($conn,$delsql2);
    
    if($delrs==true){
      if($delrs2==true) echo "9";
      else echo "2";
    }else{
      echo "3";
    }
    
  }
}
?>
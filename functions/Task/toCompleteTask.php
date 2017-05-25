<?php
session_start();
$Uid=$_SESSION['userid'];
if(isset($_POST) && $_POST){
  require_once("../to_sql.php");
  $Tid=$_POST['Taskid'];
  $sql="UPDATE task_complete SET isComplete='1' WHERE Userid='{$Uid}' AND Taskid='{$Tid}'";
  $rs=mysqli_query($conn,$sql);
  if($rs==true){
    echo "1";
  }else{
    echo "2";
  }
}else{
  echo "9";
}
?>
<?php
$flag=true;//Verify to_sql.php
require_once("../to_sql.php");
$RID=$_POST['RID'];//当前会话的对方ID
$SID=$_POST['SID'];//当前用户ID
$CT=$_POST['Content'];
if(!$SID || !$RID){die('2');}//Failed Users
if(!$CT){die('3');}//Failed Content

//双人ID拼接
if($SID<$RID){$who=$SID.",".$RID;}
else{$who=$RID.",".$SID;}

$sql="INSERT INTO chat_content(SenderID,RecipientID,whoID,content) VALUES ('{$SID}','{$RID}','{$who}','{$CT}')";
$rs=mysqli_query($conn,$sql);
if(!$rs){die('9');}
else{die('1');}

?>
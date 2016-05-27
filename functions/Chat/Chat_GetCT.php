<?php
$flag=true;//verify to_sql.php
require_once("../to_sql.php");
$LID=$_POST['LID'];//最后一条消息的ID
$SID=$_POST['SID'];//目前登录用户ID
$RID=$_POST['RID'];//目前对话的对方ID

//ID组合
if($SID>$RID){$who=$RID.",".$SID;}
else{$who=$SID.",".$RID;}
$ct="";
$whos="";

//获取最后一条消息的ID
$sql = "select * from chat_content ORDER BY id DESC LIMIT 0,1";
$result = mysqli_fetch_array(mysqli_query($conn,$sql));
$lastid=$result['id'];


//貌似已经实现【从指定消息后获取】
$ccsql="SELECT * FROM chat_content where whoID='{$who}'";// limit ".$LID.",".$lastid;
$chatcontent=mysqli_query($conn,$ccsql);
$t = new stdClass();
$t->msg = array();
$ti=0;
while($rs=mysqli_fetch_array($chatcontent)){
  if(!$rs){
    die();//没有消息
  }
  $t->msg[$ti] = new stdClass();
  //判断发送者身份，whos直接为div-id
  if($rs['SenderID']==$SID){
    $t->msg[$ti]->whos="I";
    $t->msg[$ti]->ct=$ct.$rs['content'];
  }
  if($rs['SenderID']==$RID){
    $t->msg[$ti]->whos="SHE";
    $t->msg[$ti]->ct=$ct.$rs['content'];
  }
  ++$ti;
}
die(json_encode($t));

?>

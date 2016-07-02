<?php 
session_start(); 
$flag=true;//Verify to_sql.php
require_once("../functions/to_sql.php");
//姓氏拼音首字母串定义
$surname="ABCDFGHJKLMNOPQRSTWXYZ";
//循环过程中抽取字母串的位置
$c=-1;
$uid=$_SESSION['userid']; //目前登录用户ID

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Zhixin StudentUnion OA System #Codename"SUsage" MSG System Version 0.2.1-milestone1 -->
<!-- ©2016 @Zhxsupc -->
<!-- something new -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $h=date('G');if ($h<6) echo '<link rel="stylesheet" href="../res/css/themes/night.css" />';else if ($h>22) echo '<link rel="stylesheet" href="../res/css/themes/night.css" />';else echo '<link rel="stylesheet" href="../res/css/themes/day.css" />';?>
<link rel="stylesheet" href="/SUsage/res/css/md/material.css" />
<link rel="stylesheet" href="/SUsage/res/css/modules/ex-mail.css" />
<link rel="stylesheet" href="../res/css/modules/ex-united.css" />
<title>朝发白帝，暮到江陵 / VegeChat </title>
<link rel="shortcut icon" href="/SUsage/res/icons/title/chat_128X128.ico"/>
</head>

<body style="position:absolute;width:100%;">
<?php 
require_once("../functions/Personal.php"); 
?>

<!--
<?php 
include("../../functions/showbanner.html"); 
?>
-->

<!-- 站内信主体 -->
<div id	="ex-mail-entity-all">

<!-- 收件箱主体 -->
<div id="ex-mail-entity-container-inbox">

<div class="card" id="ex-mail-entity-container-inbox-list">
<!-- 姓氏排序 -->
<?php
for($t=0; $t<22; $t++){ 
	//从0开始，从A开始获取
	$c=$c+1; 
	//根据位置抽取对应字母
	$nowsurname=substr($surname,$c,1);
  $sql="select * from sys_user order by id asc";
  $result=mysqli_query($conn,$sql);
  $total=mysqli_num_rows($result);
  $page=isset($_GET['page'])?intval($_GET['page']):1;//当前页码  
  $info_num=100; //一页显示数据数量
  $totalpage=ceil($total/$info_num); //总共页数
  $offset=($page-1)*$info_num; 
  $info=mysqli_query($conn,"select * from sys_user WHERE sname='{$nowsurname}' order by id desc limit $offset,$info_num");
?>

<!-- 字母列表 -->

	<ul class="list">
		<li><?php echo $nowsurname; ?></li>
	</ul>
	
<!-- 用户列表 -->
<?php while($rs=mysqli_fetch_array($info)){ 
	$id=$rs["id"]; //目前这行的用户ID
	$sql="SELECT * FROM chat_content WHERE SenderID='{$id}' AND RecipientID='{$uid}'";
	$query=mysqli_fetch_array(mysqli_query($conn,$sql));
?>

<ul class="list">
	<li ripple>
	<a href="chat_room.php?my=<?php echo $uid;?>&you=<?php echo $id;?>">
		<img class="item-icon" src="<?php echo $rs['headimg']; ?>">
		  <span class="item-text" style="font-family:微软雅黑;">
		    <?php echo $rs['stuid']."(".$rs['tname'].")"; ?> 
			  <!-- 获取用户最新消息 -->
		    <span class="secondary-text">			
			    <?php echo $query['content']; ?>
		    </span>
		  </span>
		</a>
	</li>
</ul>
<?php } } ?>
</div>


<div class="card" id="ex-mail-entity-container-inbox-viewer">
<p style="text-align:center;font-family:微软雅黑;font-size:14px;line-height:8px;font-weight:bold">找个人聊天吧w</p>
<div class="info-container">
<!-- Edit Here 在这里用PHP循环获取消息-->
	<div class="your">呆着干嘛呢！还不去发消息<s>骚扰</s>别人w</div>
	<div class="my">知道了知道了知道了啦！【委屈脸</div>
	<div class="your">◀ 点击左侧用户头像<b>搞个大新闻！</b></div>
</div>

</div>

<!-- 收件箱结束-->
</div>



<!--脚本引用-->
<script src="/SUsage/res/js/jquery-2.2.1.min.js"></script>
<script src="/SUsage/res/js/basic.js"></script>
<script>
function easteregg(){
 if(event.altKey  &&  event.shiftKey  &&  event.keyCode == 71){
  window.location.href = "about.html";
 }
}


document.onkeydown = function(){easteregg();};
</script>
</body>
</html>

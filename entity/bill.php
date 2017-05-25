<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/CheckLogged.php");
include("../functions/NightShift.php");
include("../functions/SO_API.php");
$Billq=mysqli_query($conn,"SELECT * FROM bill_money ORDER BY id DESC LIMIT 0,1");
$Bill=mysqli_fetch_row($Billq);
?>
<html lang="zh">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<title>账务公开 / SUsage Bill</title>
		<link rel="stylesheet" type="text/css" href="../res/css/modules/ex-ucenter.css">
		<link rel="shortcut icon" href="../res/icons/title/files_128X128.ico"/>
		<link rel="stylesheet" href="../res/css/themes/Sinterface.css" />
		<link rel="stylesheet" href="../res/css/modules/ex-united.css" />
		<style>.card{left:0;margin-bottom: 30px;margin-top:120px;width:75%}</style>
	</head>
	
	<body>
	<?php ShowNavbar(); ?>
	
		<article class="htmleaf-content">
			<div class="subtitle"><h2 style="color:#4fb4f7">账务公开<span style="font-size: 14px"> / Bill</span></h2><span style="text-align: center;">除非注明，以下单位皆为人民币元（￥，RMB）</span></div>
				<center class="card" style="height: 330px;overflow-y:auto;">
					<div id="earncircle" class="circle">
						<div id="earn" class="billtotal">总收入<p><?php echo $Bill[2]; ?></p></div>
					</div>
					<div id="costcircle" class="circle">
						<div id="cost" class="billtotal">总支出<p><?php echo $Bill[1]; ?></p></div>
					</div>
					<div id="balcircle" class="circle">
						<div id="balance" class="billtotal">结余<p><?php echo $Bill[3]; ?></p></div>
					</div>
					<div id="updatedate">最后更新：<?php echo $Bill[5]; ?></div>
				</center>
				<center class="card" id="details">				
					<div style="font-size: 20px;color:#ff80ab;padding-bottom: 40px">账务明细</div>
				<?php
				if($_SESSION['SU_See']=="1"){ 
				 @include("BillList.php");
				}else{
				?>
				<div style="margin-top: 10px">你暂时没有权限查看。<a href="http://dwz.cn/susagefb">告诉我为什么?</a></div>
				<?php } ?>
				</center>
		</article>	
		
<script src="../res/js/basic.js"></script>
<script src="../res/js/jquery-2.2.1.min.js"></script>
<script src="../res/js/ucenter.js"></script>
</body>
</html>
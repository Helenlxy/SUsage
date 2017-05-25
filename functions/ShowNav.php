<?php
$url=$_SERVER['PHP_SELF']; 
$nowpg=explode("/",$url);
$nowpg=$nowpg[count($nowpg)-1];
$nowpg=substr($nowpg,0,strlen($nowpg)-4);
$h=date("G");
?>

<link rel="stylesheet" href="../res/css/themes/bootstrap.css">
<script src="../res/js/jquery-2.2.1.min.js"></script>
<script src="../res/js/index.js"></script>
<script src="../res/js/bootstrap.js"></script>
<nav id="nav" class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="menubtn"> 菜单 </span>
			</button>
			<?php if($nowpg=="index"){ ?>
				<a class="navbar-brand" style="color:#319e29">任务</a>
				<a class="navbar-brand" href="bill.php">账务</a>
			<?php }else if($nowpg=="bill"){ ?>
				<a class="navbar-brand" href="index.php">任务</a>
				<a class="navbar-brand" style="color:#319e29">账务</a>
			<?php }else{ ?>
				<a class="navbar-brand" href="index.php">任务</a>
				<a class="navbar-brand" href="bill.php">账务</a>
			<?php } ?>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a id="backtotop" class="hide" onclick="backtop(); return false" style="cursor:pointer;">返回顶部</a></li>
			<li><a href="UCenter.php" title="点击进入个人中心">欢迎回来，
					<?php 
					echo $_SESSION['nickname'];
					?></a>
				</li>
				<li><a href="logout.php">注销</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

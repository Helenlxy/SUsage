<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/CheckLogged.php");
include("../functions/NightShift.php");
include("../functions/SO_API.php");

$CSSPath=array("themes","themes","modules","modules");
$CSSName=array("bootstrap","Sinterface","united","ucenter");
$JSName=array("jquery-2.2.1.min","ucenter");
?>

<html lang="zh">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>个人中心 / SUsage UCenter</title>
		
		<?php
		 ShowCSS($CSSPath,$CSSName);
		 ShowJS($JSName);
		?>
		
		<link rel="shortcut icon" href="../res/icons/title/login_128X128.ico">
	</head>
	<body>
	<?php ShowNavbar(); ?>
		<div class="subtitle"><h2 style="color:#4fb4f7">个人中心<span style="font-size: 14px"> / UCenter</span></h2></div>
		<!-- fieldsets -->
		<div id="pwset" class="container text-center">
			<div class="row text-center" style="padding-top:40px"> 
				<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
					<div class="col-md-offset-2 col-md-8">	
						<h2 class="fs-title">个人信息<span style="font-size: 14px"> / Information</span></h2>
						<br>
						<h4 class="fs-subtitle">修改密码</h4>
						<br>
						<p style="font-size:13px;color:red">只能使用数字、字母和符号,<span style="color:#909090">支持 <font style="color:#4fb4f7">^*:~?+/,.</font> 共11种符号</span><br>						
						<br>
							<input class="form-control" type="password" id="NewPW" onfocus="CapsLock();return false" placeholder="不要告诉别人你的密码">
						<br>
							<input class="form-control" type="password" id="CheckNewPW"  onfocus="CapsLock();return false" placeholder="请再输一遍密码">
							<br>
						<button id="ChangePW" class="btn" onclick="ChangePW();" style="width:100%">修改密码</button>

							<span id="cpslock" class="cpstips" style="display: none">大写锁定已打开</span>
						<br>
						<br>
						<h4 class="fs-subtitle" style="color: #bdbdbd">—————— or ——————</h4>
						<br>
						<br>
						<h4 class="fs-subtitle">修改SUsage ID和昵称</h3>
						<br>
							<input class="form-control" type="text" id="NewNickname" placeholder="新的昵称，只能使用字母和数字" onkeyup="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')" onpaste="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')" oncontextmenu = "value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')">
						<br>
						<p style="font-size:12px;color:red">请牢记，这也是你的SUsage ID。</p>
						<p style="color:#909090;font-size:12px">如果你改了大名，或者是部门调动，请联系管理员<span style="color:#4fb4f7">(主席团、电脑部APP组成员)</span>修改。</p>
						<button id="ChangeNickname" class="btn" onclick="ChangeNickname();" style="width:100%">确认昵称</button>
						<br>
						<br>
					</div>
				</div>
			</div>
		</div>

		<div class="container text-center" style="margin-bottom: 50px">
			<div class="row text-center"> 
				<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
					<div class="col-md-offset-2 col-md-8">	
						<h2 class="fs-title">帮助中心<span style="font-size: 14px"> / Hints & Feedbacks</span></h2>
						<br>
						<br>
						<a href="https://github.com/zhxsu/SUsage/wiki/%E5%B8%AE%E5%8A%A9%E4%B8%8E%E5%8F%8D%E9%A6%88%E4%B8%AD%E5%BF%83-%7C-Hints-&-Feedbacks" class="btn" style="width:100%">查看帮助</a>
						<br>
						<br>
					</div>
				</div>
			</div>
		</div>
			

<script>
function ChangePW(){
NewPW=$("#NewPW").val();
CheckPW=$("#CheckNewPW").val();

if(NewPW == "" || CheckPW == ""){
	alert("请输入密码");return;
}
if(NewPW != CheckPW){
	alert("两次输入的密码不相符");return;
}
if(NewPW.length<6){
	alert("密码长度不足6位");return;
}

$.ajax({
	url:"../functions/UCenter/ChangePW.php",
	type:"POST",
	data:{PW:NewPW},
	error:function(e){alert("未知错误");},
	success:function(gpw){
		if(gpw=="0"){alert("数据传输出错！");}
		else if(gpw=="2"){alert("修改成功！请重新登录！");window.location.href="logout.php";}
		else if(gpw=="3"){alert("数据库处理失败！修改失败！");}
		else{alert("Ohhhh！\n修改密码失败了！\n\n请把错误码提交给开发组："+gpw);}
	}
});
}

function ChangeNickname(){
NewNickname=$("#NewNickname").val();
$.ajax({
	url:"../functions/UCenter/ChangeNickname.php",
	type:"POST",
	data:{Nickname:NewNickname},
	error:function(e){alert("OMG");},
	success:function(gnn){
		if(gnn=="0"){alert("未输入昵称或数据传输出错！");}
		else if(gnn=="1"){alert("此用户名已存在，请使用其他用户名！");}
		else if(gnn=="2"){alert("修改成功！即将退出SUsage。");window.location.href="logout.php";setCookie("SUsageusr","");}
		else if(gnn=="3"){alert("数据传输失败！修改失败！");}
		else{alert("网络连接失败！"+gnn);}
	}
});
}


function isIE(){ 
	if(!!window.ActiveXObject || "ActiveXObject" in window){
		return true; 
	}else{ 
		return false; 
	} 
} 
	
(function(){ 
	var inputPWD=document.getElementById('NewPW'); 
	var chkPWD=document.getElementById('CheckNewPW'); 
	var capital=false; 
	var capitalTip={ 
		elem:document.getElementById('cpslock'), 
		toggle:function(s){ 
			var sy=this.elem.style; 
			var d=sy.display; 
			if(s){ 
				sy.display = s; 
			}else{ 
				sy.display=d=='none'?'':'none'; 
			} 
		} 
	} 
	var detectCapsLock=function(event){ 
	if(capital){return}; 
	var e = event||window.event; 
	var keyCode = e.keyCode||e.which;
	var isShift = e.shiftKey ||(keyCode == 16 ) || false ;
	if(((keyCode>=65&&keyCode<=90 )&&!isShift)||((keyCode>=97&&keyCode<=122 )&&isShift)){
		capitalTip.toggle('inline-block');
		capital=true
	}else{
		capitalTip.toggle('none');
	} 
} 
if(!isIE()){
	inputPWD.onkeypress=detectCapsLock; 
	chkPWD.onkeypress=detectCapsLock; 
	chkPWD.onkeyup=function(event){ 
		var e = event||window.event; 
		if(e.keyCode == 20 && capital){ 
			capitalTip.toggle(); 
			return false; 
		} 
	} 
	inputPWD.onkeyup=function(event){ 
		var e = event||window.event; 
		if(e.keyCode == 20 && capital){ 
			capitalTip.toggle(); 
			return false; 
		} 
	} 
}
})()
</script>
</body>
</html>
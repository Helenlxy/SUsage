<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/CheckLogged.php");
include("../functions/NightShift.php");
include("../functions/SO_API.php");

$CSSPath=array("editor","themes","modules","modules");
$CSSName=array("cropper.min","Sinterface","ex-united","ex-ucenter");
$JSName=array("jquery-2.2.1.min","lrz.all.bundle","cropper.min","ucenter","basic","easteregg");
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
		<style>#qrcode{width:373px;height:400px}@media(max-width:500px){#qrcode{display: none}}
		#qrtips{display: none}@media(max-width:500px){#qrtips{display: inline}}</style>
	</head>
	<body>
	<?php ShowNavbar(); ?>
		<article class="htmleaf-content">
			<div class="subtitle"><h2 style="color:#4fb4f7">个人中心<span style="font-size: 14px"> / UCenter</span></h2></div>
			<!-- fieldsets -->
			<center id="avatarset" class="card">
				<h2 class="fs-title">露个脸呗<span style="font-size: 14px"> / Avatar</span></h2>
				<h3 class="fs-subtitle">上传你的头像,由于技术问题此功能尚未开放。<br><br>如果你需要更换头像，你可以在下方扫描二维码，<br>在群中@df7c5117或@后端开发兼运维 小生蚝，<br>也可以私聊他们并发送<br><b>自行裁剪过、分辨率不低于150*150的、尽量是正方形的</b>图片<br>来设定自己的头像
			</center>
			<center id="pwset" class="card">
				<h2 class="fs-title">个人信息<span style="font-size: 14px"> / Information</span></h2>
				<h3 class="fs-subtitle">修改你的密码。看准了，别写错</h3>
				<p style="font-size:13px;color:red">只能使用数字、字母和符号,<span style="color:#909090">支持 <font style="color:#4fb4f7">^*:~?+/,.</font> 共11种符号</span><br>
					<span id="cpslock" class="cpstips" style="display: none">大写锁定已打开</span></p>
					<input class="text-input ipt" type="password" id="NewPW" onfocus="CapsLock();return false" placeholder="不要告诉别人你的密码">
					<input class="text-input ipt" type="password" id="CheckNewPW"  onfocus="CapsLock();return false" placeholder="请再输一遍密码">
					<button id="ChangePW" class="btn raised green" onclick="ChangePW();" style="width:50%">修改密码</button>
					
				<h3 class="fs-subtitle" style="color: #bdbdbd">—————— or ——————</h3>
				<h3 class="fs-subtitle">修改SUsage ID和昵称，请来这里</h3>
				
					<input class="text-input ipt" type="text" id="NewNickname" placeholder="新的昵称，只能使用字母和数字" onkeyup="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')" onpaste="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')" oncontextmenu = "value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')">
				<p style="font-size:12px;color:red">请牢记，这也是你的SUsage ID。</p>
				<p style="color:#909090;font-size:12px">如果你改了大名，或者是部门调动，请联系管理员<span style="color:#4fb4f7">(主席团、电脑部APP组成员)</span>修改。</p>
				
				<button id="ChangeNickname" class="btn raised green" onclick="ChangeNickname();" style="width:50%">确认昵称</button>
			</center>
			
			<center id="helper" class="card">
				<h2 class="fs-title">反馈与帮助中心<span style="font-size: 14px"> / Feedback</span></h2>
				<h3 class="fs-subtitle">遇到使用中的问题，或者寻求帮助，可以联系我们</h3>
				<h3 class="fs-subtitle" style="color: #bdbdbd;margin-top: 40px">—————— 用户群 ——————</h3>
				<center>
					<!--span>企鹅群：<a>324430720</a></span--><br>
					<img id="qrcode" src="../qrcode.jpg"/><br>
					<span id="qrtips">请在电脑版网页扫描二维码加入.</span><br>
					<span>如果需要帮助和反馈，也可以在群里私聊负责人。</span>

				<h3 class="fs-subtitle" style="color: #bdbdbd;margin-top: 40px">—————— 帮助 ——————</h3>
					<input type="submit" name="contact1" class="btn raised blue" style="display:inline-block;width: 50%" value="查看帮助" onclick="window.location.href = 'http://dwz.cn/susagefb'">
				</center>
			</center>
		</article>

<script>
document.onkeydown = function(){easteregg();};

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
  error:function(e){alert("OMG！未知错误！");},
  success:function(gpw){
    if(gpw=="0"){alert("数据传输出错！");}
    else if(gpw=="2"){alert("修改成功！请重新登录！");window.location.href="logout.php";}
    else if(gpw=="3"){alert("数据库处理失败！修改失败！");}
    else{alert("Ohhhh！\n修改密码失败了！\n\n请宝宝把错误码提交给APP组："+gpw);}
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


window.onload=function(){
  $("#hdimg").addClass('animate rubberBand');
  $("#changeAvatar").addClass('animate rubberBand');
  setTimeout("$('#namebox').addClass('animate bounceIn');", 400); 

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
}
</script>
</body>
</html>
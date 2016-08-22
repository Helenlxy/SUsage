<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/CheckLogged.php");
include("../functions/NightShift.php");
include("../functions/SO_API.php");
?>

<html lang="zh">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<title>个人中心 / SUsage UCenter</title>
		<link rel="stylesheet" type="text/css" href="../res/css/modules/ex-ucenter.css">
		<link rel="stylesheet" href="../res/css/editor/cropper.min.css">
		<link rel="shortcut icon" href="../res/icons/title/login_128X128.ico"/>
		<link rel="stylesheet" href="../res/css/themes/Sinterface.css" />
		<link rel="stylesheet" href="../res/css/modules/ex-united.css" />
		<script src="../res/js/lrz.all.bundle.js"></script>
		<script src="../res/js/jquery-2.2.1.min.js" type="text/javascript"></script>
		<script src="../res/js/cropper.min.js"></script>
		<script src="../res/js/ucenter.js"></script>
		<script src="../res/js/basic.js"></script>
	</head>
	<body>
	<?php ShowNavbar(); ?>
		<article class="htmleaf-content">
			<div class="subtitle"><h2 style="color:#4fb4f7">个人中心<span style="font-size: 14px"> / UCenter</span></h2></div>
			<!-- fieldsets -->
			<center id="avatarset" class="card">
				<h2 class="fs-title">露个脸呗<span style="font-size: 14px"> / Avatar</span></h2>
				<h3 class="fs-subtitle">上传你的头像,此功能尚未开放。<!--span style="color:red">  建议使用正方形图片</span><br><span style="color:#00c853">墙裂建议在更换图像前确认你“个人信息”模块中填写的数据已提交</span--></h3>
					<!--div id="showResult" style="display: block;">
						<div style="width: 50%;margin: 0 auto;margin-top: 10px;">
							<input id="image" type="file" accept="image/*" capture="camera">
						</div>
						<div id="changeAvatar" style="margin-top: 35px;"><img src="<?php echo $_SESSION['headimg']; ?>" class="avt">
						</div>
					</div>
					<div id="showEdit" style="width: 400px; height: 400px; position: absolute; left: 15%; z-index: 9; display: none;">
						<div style="width:100%;z-index:999999;position: absolute;top:10px;left:0px;border-radius: 4%">
							<button class="avbtn" id="cancleBtn" style="z-index:99999;float:left;margin-left:10px;background-color: #fff;color:#000">取消</button>
							<button class="avbtn" id="confirmBtn" style="z-index:999999;float:right;margin-right: 10px;">确定</button>
						</div>
						<div id="report">
							<img src="" style="margin-left: 0px; margin-top: 0px; transform: none;">
							<span class="cropper-dashed dashed-h cropper-hidden"></span>
							<span class="cropper-dashed dashed-v cropper-hidden"></span>
							<span class="cropper-center"></span>
							<span class="cropper-face cropper-invisible cropper-move"></span>
							<span class="cropper-line line-e cropper-hidden" data-action="e"></span>
							<span class="cropper-line line-n cropper-hidden" data-action="n"></span>
							<span class="cropper-line line-w cropper-hidden" data-action="w"></span>
							<span class="cropper-line line-s cropper-hidden" data-action="s"></span>
							<span class="cropper-point point-e cropper-hidden" data-action="e"></span>
							<span class="cropper-point point-n cropper-hidden" data-action="n"></span>
							<span class="cropper-point point-w cropper-hidden" data-action="w"></span>
							<span class="cropper-point point-s cropper-hidden" data-action="s"></span>
							<span class="cropper-point point-ne cropper-hidden" data-action="ne"></span>
							<span class="cropper-point point-nw cropper-hidden" data-action="nw"></span>
							<span class="cropper-point point-sw cropper-hidden" data-action="sw"></span>
							<span class="cropper-point point-se cropper-hidden" data-action="se"></span>
						</div>
					</div-->		
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
					<span>微信群您已添加。</span><br>
					<span>如果需要帮助和反馈，也可以在群里私聊负责人。</span>

				<h3 class="fs-subtitle" style="color: #bdbdbd;margin-top: 40px">—————— 帮助 ——————</h3>
					<input type="submit" name="contact1" class="btn raised blue" style="display:inline-block;width: 50%" value="查看帮助" onclick="window.location.href = 'http://dwz.cn/susagefb'">
				</center>
			</center>
		</article>

<script src="../res/js/basic.js"></script>
<script src="../res/js/easteregg.js"></script>
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
  error:function(e){alert("OMG！未知错误！"+eval(e));},
  success:function(gpw){
    if(gpw=="0"){alert("数据传输出错！");}
    else if(gpw=="2"){alert("修改成功！请重新登录！");}
    else if(gpw=="3"){alert("数据库处理失败！修改失败！");window.location.href="logout.php";}
    else if(gpw=="9"){alert("密码需包含6位以上的字母、数字或符号（部分）任意三种。");}
    else{alert("网络连接失败！"+gpw);}
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
    else if(gnn=="2"){alert("修改成功！即将退出SUsage。");window.location.href="logout.php";}
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
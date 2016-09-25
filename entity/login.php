<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>欢迎回来 / SUsage Login</title>
		<link href="../Admin/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../res/css/themes/Sinterface.css" />
		<link rel="shortcut icon" href="../res/icons/title/login_128X128.ico"/>
    <style>input::-webkit-input-placeholder{text-align: center;};.lgi{background:none;border-radius: 5px}.lgi:focus{border:1px solid #4fb4f7}.checkbox input[type="checkbox"] + label::after {margin-left: -0.35em;margin-top: -0.3em;}</style>
	</head>
	<body style="padding-top:120px;background-color:#64B5F6">
		<!--通知popup-->
		<div id="codetips" style="background-color:#D50000;position:fixed;top:0px;width:100%;height:30px;z-index:100;display:none;">
			<p style="font-family:微软雅黑;color:#ffffff;position:absolute;width:100%;text-align:center;line-height:0px;" id="LoginTips"></p>
    </div>
    <div id="cpslock" style="background-color:#D50000;position:fixed;top:0px;width:100%;height:30px;z-index:100;display:none;">
      <p style="font-family:微软雅黑;color:#ffffff;position:absolute;width:100%;text-align:center;line-height:0px;">大写锁定已打开</p>
		</div>

<div class="container text-center">
<div class="row text-center" style="padding-top:40px"> 
<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
  <div class="col-md-offset-2 col-md-8" style="line-height:12px;">
            <h2 style="color:#66ccff;font-size: 25px">你好，SUer<br>
          <h3 style="color:#66ccff">欢迎回到SUsage</h3>
        </h2>
        <div class="input-group">
          <input class="form-control lgi" placeholder="SUsage ID" id="id" onkeyup="if(event.keyCode==13)$('#pw')[0].focus();">
        </div>
        <br>
        <div class="input-group">
          <input class="form-control lgi" placeholder="Password" id="pw" onkeyup="if(event.keyCode==13)toLogin();" type="password">
        </div>
        <div class="checkbox" style="margin:15px 5% 0 5%;display:block;">
          <input type="checkbox" id="usrcookie">
          <label for="usrcookie" style="display:inline-block;width:22px;height:22px"></label>
          <span class="lablink">记住用户名</span>
        </div>
        <button onclick="toLogin();" id="btn" class="btn raised green" style="width:60%;margin-top:30px">登陆</button>  
  </div>
</div>
</div>
</div>

			<!-- Footer -->
			<center style="font-size:12px;color:#ffffff"><b>SUsage</b> Release 1.0 · <a href="http://dwz.cn/susagefb" target="_blank" style="color:#ffffff">帮助与反馈中心 </a>· ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#ffffff;text-decoration:underline">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#ffffff;text-decoration:underline">电脑部</a> · In tech we trust</center>
		</article>
	</body>

<script src="../res/js/jquery-2.2.1.min.js" type="text/javascript"></script>
<script src="../res/js/cookie.js" type="text/javascript"></script>
<script type="text/javascript">
var tips = document.getElementById('codetips');
var TipsContent = document.getElementById('LoginTips');
var InputID = document.getElementById('id');
var InputPW = document.getElementById('pw');
var CountErrorPW = 0;

window.onload=function(){
  usrid=document.getElementById('id');
  usrid.value=getCookie("SUsageusr");
  function isIE(){ 
    if(!!window.ActiveXObject || "ActiveXObject" in window){ 
      return true; 
    }else{ 
     return false; 
    } 
  } 
  (function(){ 
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
    InputPW.onkeypress=detectCapsLock;
    InputPW.onkeyup=function(event){
      var e = event||window.event; 
      if(e.keyCode == 20 && capital){ 
        capitalTip.toggle(); 
        return false; 
      } 
    } 
    }
  })()
}


function showtips(tipsct){
  TipsContent.innerHTML = tipsct;
  tips.style.display = "block";
  setTimeout("hidetips()",3000);
}

function hidetips(){
  tips.style.display = "none";
}

function toIndex(){
  window.location.href="index.php";
}

function ErrorPW(){
  showtips("孩纸不急~先把密码输对哦！");
  $("#id")[0].disabled=0;
  $("#pw")[0].disabled=0;
  $("#btn")[0].disabled=0;
  $("#btn").html("登录");
  InputPW.value="";
  $('#pw')[0].focus();
  CountErrorPW ++;
}

function usrcookie(usrname){
  setCookie("SUsageusr",usrname);
}

function toLogin(){
  $("#id")[0].disabled=1;
  $("#pw")[0].disabled=1;
  $("#btn")[0].disabled=1;
  var stuid=$("#id").val();
  var pw=$("#pw").val();
  $("#btn").html("<img src='../res/icons/loading.gif'>");
  if(CountErrorPW < 5){
    if(stuid==""){
      showtips("请输入用户名");
      $("#id")[0].disabled=0;
      $("#pw")[0].disabled=0;
      $("#btn")[0].disabled=0;
      $("#btn").html("登录");
      $('#id')[0].focus();return;
    }
    if(pw==""){
      showtips("请输入密码");
      $("#id")[0].disabled=0;
      $("#pw")[0].disabled=0;
      $("#btn")[0].disabled=0;
      $("#btn").html("登录");
      $('#pw')[0].focus();return;
    }
    var ck = document.getElementById('usrcookie');
    if(ck.checked==true){usrcookie(stuid);}
    $.ajax({
    type:"POST",
    url:"verify.php",
    data:{id:stuid,pw:pw},
    success:function(g){
      if(g=="233") AccountLockT();
      else if(g=="1") toIndex(id);
      else if(g=="2") ErrorPW();     
      else{
        alert("未知错误！错误码："+g.toString());
        $("#id")[0].disabled=0;
        $("#pw")[0].disabled=0;
        $("#btn")[0].disabled=0;
        $("#btn").html("登录");
      }
    },
    error:function(e){
      alert("传输错误！错误码："+e.toString());
    }
    });
  }else{   
    AccountLockI(stuid);
  }
}

function AccountLockT(){
  showtips("密码错误次数过多导致账户被锁定，请联系电脑部App组");
  $("#id")[0].disabled=0;
  $("#pw")[0].disabled=0;
  $("#btn")[0].disabled=1;
  $("#btn").html("已锁定");
  InputPW.value="";
  InputID.value="";
}

function AccountLockI(id){
  SignN = <?php echo $r=mt_rand(mt_rand(396,935),7295); ?>;
  SignD = <?php echo $d=date("is")-6; ?>;
  Sign = <?php echo $d*$r%152+233; ?>;
  $.ajax({
   url:"../functions/UCenter/toLockAccount.php",
   data:{uid:id,SignN:SignN,SignD:SignD,Sign:Sign},
   type:"POST",
   success:function(g){
    if(g=="666"){
     alert("Sign签名验证失败！");
     location.reload();
    }else if(g=="2"){
     AccountLockT();
    }else{
     alert("网络连接失败！");
     location.reload();
    }
   },
   error:function(){AccountLockI(id);}
  });
}
</script>
</html>
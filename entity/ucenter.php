<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>个人中心 / SUsage UCenter</title>
   	<link rel="stylesheet" type="text/css" href="../res/css/modules/ex-ucenter.css">
    <link rel="shortcut icon" href="../res/icons/title/login_128X128.ico"/>
</head>
<body style="text-align:center;">
	<!--通知popup-->

<header class="htmleaf-header" style="padding-top:50px">
   
				<p style="color:#FFFFFF;font-size:24px">SUsage / 个人中心 <span style="font-size:15px;background: #27AE60;border-radius: 5px;padding:0px 5px 0px 5px">beta</span></p>  
	</header>
     
    <div style="font-size:12px;color:#FFFFFF;padding-top:30px;">SUsage 桌面版1.0 · 
    <a href="https://github.com/zhxsu/SUsage/wiki/%E5%B8%AE%E5%8A%A9%E4%B8%8E%E5%8F%8D%E9%A6%88%E4%B8%AD%E5%BF%83-%7C-Hints-&-Feedbacks" target="_blank" style="color:#ffffff;text-decoration: NONE">帮助与反馈中心 </a>·<a href="http://zhxsu.github.io/SUsage/" target="_blank" style="color:#ffffff;text-decoration: NONE"> 关于 | 开源许可及协议声明 </a>· ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#ffffff">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#ffffff">电脑部</a> · In tech we trust</div>
	<article class="htmleaf-content">
		<!-- multistep form -->
		<form id="msform">
			
			<!-- fieldsets -->
			<div id="avatarset">
				<h2 class="fs-title">露个脸呗</h2>
                <h3 class="fs-subtitle">上传你的头像【尚未开放】</h3>
				<input type="button" name="submit1" class="action-button-disabled" value="点我干嘛" />
			</div>
			<div id="pwset">
				<h2 class="fs-title">修改密码</h2>
				<h3 class="fs-subtitle">看准了，别写错</h3>
				<input type="password" name="pass" placeholder="不要告诉别人你的密码" />
				<input type="password" name="cpass" placeholder="请再输一遍密码" />
				<input type="button" name="submit2" class="next action-button" value="完成" />
			</div>
			<div id="infoset">
				<h2 class="fs-title">信息变动？</h2>
				<h3 class="fs-subtitle">修改SUsage ID，请来这里</h3>
				<input type="text" name="fname" placeholder="新的昵称" />
				<p style="color:#909090;font-size:12px;color:red">请牢记，这也是你的SUsage ID。</p>
				<p style="color:#909090;font-size:12px">嗯，如果你改了大名，或者是部门调动，请联系管理员修改。</p>
				<input type="submit" name="submit3" class="submit action-button" value="完成"/>
			</div>
           
		</form>
      
	</article>
	
	<script src="../res/js/jquery-2.2.1.min.js" type="text/javascript"></script>
	<script>window.jQuery || document.write('<script src="../universal-res/js/jquery-2.2.1.min.js"><\/script>')</script>
	
    </body>
</html>
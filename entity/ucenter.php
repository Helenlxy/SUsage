<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>个人中心 / SUsage UCenter</title>
   	<link rel="stylesheet" type="text/css" href="../res/css/modules/ex-ucenter.css">
    <link rel="shortcut icon" href="../res/icons/title/login_128X128.ico"/>
    <script type="text/javascript" src="../res/js/lrz.mobile.min.js"></script> 
    <script type="text/javascript" src="../res/js/lrz.all.bundle.js"></script>
    <script src="../res/js/jquery-2.2.1.min.js" type="text/javascript"></script>
	<link href="../res/css/ucenter/cropper.min.css" rel="stylesheet">
	<script src="../res/js/cropper.min.js"></script>
	<script>window.jQuery || document.write('<script src="../universal-res/js/jquery-2.2.1.min.js"><\/script>')</script>
    <script type="text/javascript">
    $(function() {

        function toFixed2(num) {
            return parseFloat(+num.toFixed(2));
        }
		
        $('#cancleBtn').on('click', function() {
            $("#showEdit").fadeOut();
        });

        $('#confirmBtn').on('click', function() {
            $("#showEdit").fadeOut();

            var $image = $('#report > img');
            var dataURL = $image.cropper("getCroppedCanvas");
            var imgurl = dataURL.toDataURL("image/jpeg", 0.5);
            $("#changeAvatar > img").attr("src", imgurl);
            $("#basetxt").val(imgurl);
            $('#showResult').fadeIn();

        });

        function cutImg() {
            $("#showEdit").fadeIn();
            var $image = $('#report > img');
            $image.cropper({
                aspectRatio: 1 / 1,
                autoCropArea: 0.7,
                strict: true,
                guides: false,
                center: true,
                highlight: false,
                dragCrop: false,
                cropBoxMovable: false,
                cropBoxResizable: false,
                zoom: -0.2,
                checkImageOrigin: true,
                background: false,
                minContainerHeight: 400,
                minContainerWidth: 300
            });
        }

        function doFinish(startTimestamp, sSize, rst) {
            var finishTimestamp = (new Date()).valueOf();
            var elapsedTime = (finishTimestamp - startTimestamp);

            var sourceSize = toFixed2(sSize / 1024),
                resultSize = toFixed2(rst.base64Len / 1024),
                scale = parseInt(100 - (resultSize / sourceSize * 100));
            $("#report").html('<img src="' + rst.base64 + '" style="width: 100%;height:100%">');
            cutImg();
        }

        $('#image').on('change', function() {
            var startTimestamp = (new Date()).valueOf();
            var that = this;
            lrz(this.files[0], {
                    width: 800,
                    height: 800,
                    quality: 0.7
                })
                .then(function(rst) {
                    //console.log(rst);
                    doFinish(startTimestamp, that.files[0].size, rst);
                    return rst;
                })
                .then(function(rst) {
                    // 这里该上传给后端啦
                    // 伪代码：ajax(rst.base64)..

                    return rst;
                })
                .then(function(rst) {
                    // 如果您需要，一直then下去都行
                    // 因为是Promise对象，可以很方便组织代码 \(^o^)/~
                })
                .catch(function(err) {
                    // 万一出错了，这里可以捕捉到错误信息
                    // 而且以上的then都不会执行

                    alert(err);
                })
                .always(function() {
                    // 不管是成功失败，这里都会执行
                });
        });

    });
    </script>
</head>
<body style="text-align:center;">
	<!--通知popup-->

<header class="htmleaf-header" style="padding-top:50px">
   
				<p style="color:#FFFFFF;font-size:24px">SUsage / 个人中心 <span style="font-size:15px;background: #27AE60;border-radius: 5px;padding:0px 5px 0px 5px">beta</span></p>  
	</header>
    <a style="position:absolute;top:13px;left:5%;cursor:pointer;color:#fff" onclick="history.back()" ><返回上一页</a> 
    <div style="font-size:12px;color:#FFFFFF;padding-top:30px;">SUsage 桌面版1.0 · 
    <a href="https://github.com/zhxsu/SUsage/wiki/%E5%B8%AE%E5%8A%A9%E4%B8%8E%E5%8F%8D%E9%A6%88%E4%B8%AD%E5%BF%83-%7C-Hints-&-Feedbacks" target="_blank" style="color:#ffffff;text-decoration: NONE">帮助与反馈中心 </a>·<a href="http://zhxsu.github.io/SUsage/" target="_blank" style="color:#ffffff;text-decoration: NONE"> 关于 | 开源许可及协议声明 </a>· ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#ffffff">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#ffffff">电脑部</a> · In tech we trust</div>
	<article class="htmleaf-content">
		
			<!-- fieldsets -->
			<div id="avatarset" class="card">
				<h2 class="fs-title">露个脸呗</h2>
                <h3 class="fs-subtitle">上传你的头像<span style="color:red">  建议使用正方形图片</span></h3>
					<div id="showResult" style="display: block;">
        				<div style="width: 50%;margin: 0 auto;margin-top: 10px;">
            				<input id="image" type="file" accept="image/*" capture="camera">
        				</div>
						<div id="changeAvatar" style="margin-top: 35px;">
            				<img src="../storage/avatar/avatar-5117.jpg" style="width: 100px;margin-top: 10px;margin: 0 auto;display:block;border-radius: 50%">
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
        			</div>
   			 <textarea class="ta" name="txt" rows="10" id="basetxt" style="position:relative;width:100%;resize:none" onclick="this.checked = true" placeholder="base64码(测试用）"></textarea>
    
   			</div>
			<div id="pwset" class="card">
				<h2 class="fs-title">修改密码</h2>
				<h3 class="fs-subtitle">看准了，别写错</h3>
				<input class="ipt" type="password" name="pass" placeholder="不要告诉别人你的密码" />
				<input class="ipt" type="password" name="cpass" placeholder="请再输一遍密码" />
				<input type="button" name="submit2" class="next action-button" value="完成" />
			</div>
			<div id="infoset" class="card">
				<h2 class="fs-title">信息变动？</h2>
				<h3 class="fs-subtitle">修改SUsage ID，请来这里</h3>
				<input class="ipt" type="text" name="fname" placeholder="新的昵称" />
				<p style="color:#909090;font-size:12px;color:red">请牢记，这也是你的SUsage ID。</p>
				<p style="color:#909090;font-size:12px">嗯，如果你改了大名，或者是部门调动，请联系管理员修改。</p>
				<input type="submit" name="submit3" class="submit action-button" value="完成"/>
			</div>
    
      
	</article>
	
	
	
    </body>
</html>
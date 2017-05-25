<?php
require_once("../Includes/CheckLog.php");
CheckPurv("U_A");
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 用户管理</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  
  <style>
  a{color:#4caf50;}
  a:hover{color:#4fb4f7;transition: 0.6s;}
  .input-group {display: block}
  .btn-info{margin-top:20px}
  </style>
</head>

<body>
<?php include("../Includes/shownav.php"); ?>
<div class="container text-center">
<div class="row text-center" style="padding-top:20px"> 
<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
  <h3 style="color:#4CAF50">新增用户</h3><br>
  <a style="position:absolute;top:13px;left:5%;cursor:pointer" onclick="history.back()"> <返回</a>
  <div class="col-md-offset-2 col-md-8" style="line-height:12px;">
  <font color="#64B5F6">Tips：双电填</font><font color="#6D4C41">部门名</font><font color="#64B5F6">，对口主席填</font><font color="#F4511E">主席团和对口部门</font><font color="#64B5F6">并</font><font color="#9C27B0">用英文逗号隔开</font>
  <hr>
  <div class="input-group">
    <input class="form-control" placeholder="用户真实姓名" id="TrueName" onkeyup="if(event.keyCode==13)$('#Phone')[0].focus();">
  </div><br>
  <div class="input-group">
    <input class="form-control" placeholder="用户手机号码（作为初始用户名）" id="Phone" onkeyup="if(event.keyCode==13)$('#Dep')[0].focus();">
  </div><br>
  <div class="input-group">
    <input class="form-control" placeholder="用户所在部门" id="Dep" onkeyup="if(event.keyCode==13)AddUser();">
  </div>
  <button class="btn btn-info" style="width:100%" onclick="AddUser();" id="addbtn">新增</button>
  <br>
</div>
</div>
</div>
</div>
</body>

<!-- JavaScript -->
<script src="../Includes/footer.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.2/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script>
function GoBack(){
 $("#TrueName")[0].disabled=0;
 $("#Phone")[0].disabled=0;
 $("#Dep")[0].disabled=0;
 $("#addbtn")[0].disabled=0;
 $("#addbtn").html("新 增");
 $("#addbtn").removeClass("btn-success");
 $("#addbtn").addClass("btn-info"); 
}
function AddUser(){
 $("#TrueName")[0].disabled=1;
 $("#Phone")[0].disabled=1;
 $("#Dep")[0].disabled=1;
 $("#addbtn")[0].disabled=1;
 var Truename = $("#TrueName").val();
 var PhoneNumber = $("#Phone").val();
 var Dep = $("#Dep").val();
 $("#addbtn").html('<i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>');
 $("#addbtn").removeClass("btn-info");
 $("#addbtn").addClass("btn-success");
 
 if(Truename == "" || PhoneNumber == ""){
  //未填写姓名或ID
  alert("对不起！因SUsage无法识别外星人，请返回填写人类的名称和SUsage ID");
  GoBack();
 }else if(isNaN(Truename) != true){
  //姓名含有不是汉字的字符
  alert("对不起！因SUsage无法识别外星人的数字名字，请返回填写人类的汉字名字。");
  GoBack();
 }else if(/.*[\u4e00-\u9fa5]+.*$/.test(PhoneNumber)){
  //ID含有汉字
  alert("对不起！SUsage不允许ID含有汉字，请返回修改！");
  GoBack();
 }else if(Dep == ""){
  //未填写部门
  alert("对不起！SUsage暂不接受无业游民的用户，请返回填写所在部门。");
  GoBack();
 }else if(isNaN(Dep) != true){
  //部门含有不是汉字的字符
  alert("听说学生会没有含数字的部门啊！");
  GoBack();
 }else{
 
  $.ajax({
   url:"DPtoAddUsr.php",
   type:"post",
   data:{TrueName:Truename,UserName:PhoneNumber,Dep:Dep},
   error:function(e){alert("系统处理出错！"+e);GoBack();},
   success:function(g){
    if(g.substr(0,1)=="1" && g.substr(2,1)=="1"){
      alert("新增成功！\n\n初始用户名："+PhoneNumber+"初始密码："+g.substr(4,7));
      location.reload();
    }else{
      alert("新增失败！"+g);
      GoBack();
    }
   }
  });
  
 }
}
</script>
</html>
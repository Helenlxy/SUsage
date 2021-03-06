<?php
require_once("../Includes/CheckLog.php");
CheckPurv("B");

$flag=true;
require_once("../Includes/to_pdo.php");
$rs=PDOQuery($dbcon,"SELECT * FROM bill_money ORDER BY id DESC",[],[]);
$pay=$rs[0][0]['pay'];
$income=$rs[0][0]['income'];
$surplus=$rs[0][0]['surplus'];
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 账务系统</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <style>
  a{color:#4caf50;}
  a:hover{color:#4fb4f7;transition: 0.6s;}
  .btn-info{margin-top:20px}
  </style>
</head>

<body>
<?php include("../Includes/shownav.php"); ?>
<div class="container text-center">
<div class="row text-center" style="padding-top:20px"> 
<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
  <h3 style="color:#4CAF50">修改账目总额</h3><br>
  <a style="position:absolute;top:13px;left:5%;cursor:pointer" onclick="history.back()"><返回</a>
  <div class="form-horizontal">  
  <div class="form-group">
    <p class="col-sm-3 control-p">总支出</p>
    <div class="col-sm-8"><input type="text" class="form-control" onkeyup="if(event.keyCode==13)$('#income')[0].focus();" id="pay" value="<?php echo $pay; ?>"></div>
  </div>
  
  <div class="form-group">
    <p class="col-sm-3 control-p">总收入</p>
    <div class="col-sm-8"><input type="text" class="form-control" onkeyup="if(event.keyCode==13)$('#surplus')[0].focus();" id="income" value="<?php echo $income; ?>"></div>
  </div>
  
  <div class="form-group">
    <p class="col-sm-3 control-p">结余额</p>
    <div class="col-sm-8"><input type="text" class="form-control" onkeyup="if(event.keyCode==13)ChgMoney();" id="surplus" value="<?php echo $surplus; ?>"></div>
  </div>
  
  <button class="btn btn-info" style="width:100%" onclick="ChgMoney();" id="addbtn">修改账目</button>
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
 $("#pay")[0].disabled=0;
 $("#income")[0].disabled=0;
 $("#surplus")[0].disabled=0;
 $("#addbtn")[0].disabled=0;
 $("#addbtn").html("修改账目");
 $("#addbtn").removeClass("btn-success");
 $("#addbtn").addClass("btn-info"); 
}

function ChgMoney(){
 $("#pay")[0].disabled=1;
 $("#income")[0].disabled=1;
 $("#surplus")[0].disabled=1;
 $("#addbtn")[0].disabled=1;
 var pay = $("#pay").val();
 var income = $("#income").val();
 var surplus = $("#surplus").val();
 $("#addbtn").html("正在修改，请稍候……");
 $("#addbtn").removeClass("btn-info");
 $("#addbtn").addClass("btn-success");
 
 if(pay == "" || income == "" || surplus == ""){
  alert("请填写完所有内容！");
  GoBack();
 }else{
 
  $.ajax({
   url:"DPtoChgMoney.php",
   type:"post",
   data:{p:pay,i:income,s:surplus},
   error:function(e){alert("系统处理出错！"+e);GoBack();},
   success:function(g){
    if(g==1){
      alert("修改成功！");
      location.reload();
    }else{
      alert("修改失败！错误码："+g);
    }
   }
  });
  
 }
}
</script>
</html>
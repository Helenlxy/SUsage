<?php 
session_start();
require_once("../functions/to_sql.php");
include("../functions/NightShift.php");

$group=$_SESSION['group'];
$pubman=$_SESSION['truename'];
$sql=mysqli_query($conn,"SELECT * FROM task_list WHERE redep LIKE '%$group%'");
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--引入wangEditor.css等样式表-->
<link rel="stylesheet" href="../res/css/themes/Sinterface.css" />
<?php
if($_SESSION['SUmaster']==1){
  echo "<link rel='stylesheet' href='../res/css/modules/ex-index-master.css' />";
}else{
  echo "<link rel='stylesheet' href='../res/css/modules/ex-index-normal.css' />";
}
?>
<link rel="stylesheet" href="../res/css/editor/wangEditor.css">
<link rel="stylesheet" href="../res/css/modules/ex-united.css" />
<!--网站标题以及icon-->
<title>你的任务 / SUsage Tasklist </title>
<link rel="shortcut icon" href="../res/icons/title/task_128X128.ico"/>
</head>

<body style="position:absolute;width:80%;">

<!--导航栏从此开始 -->
<div class="ex-navbar-for-Desktop">
  <span class="mui-badge mui-badge-red" id="noti" style="display:none;left:250px" title="你收到了新通知"><b>New</b></span>
  <!--用户标签-->
  <a href="ucenter.php" class="ex-dnavbar-userbox-descunderunfb" title="进入个人中心">
  <div class="ex-dnavbar-userbox">
    <div class="ex-dnavbar-userbox-avatarfixbox">
      <img src="<?php echo $_SESSION['headimg']; ?>" style="height:54px;width:54px;" />
    </div>
    <div class="ex-dnavbar-userbox-usernamefixbox">
      <p class="ex-dnacvar-userbox-username">
        <?php 
        echo $_SESSION['nickname']." , ";
        if ($h<5) echo '该休息了';
        else if ($h<11) echo '早上好呀';
        else if ($h<13) echo '到中午了';
        else if ($h<18) echo '下午好嘛';
        else if ($h<23) echo '天黑了呢';
        else echo '该休息了';
        ?>
      </p>
    </div>
    <div class="ex-dnavbar-userbox-descunderunfixbox">
      <a onclick="backtop(); return false" class="ex-dnavbar-userbox-descunderunfb" href="#">返回顶部 ▲ </a>&#12288;<a onclick="exit(); return false" class="ex-dnavbar-userbox-descunderunfb" title="戳一下就退出哦w">注销 ></a>
    </div>
  </div>
  </a>
  
  <div id="appfixbox">
  <div class="ex-dnavbar-appbox appbox-selected">
    <img src="../res/icons/bar/ic_task.png"/>
    <div class="ex-dnavbar-appbox-text">主页</div>
  </div>
 </div>
</div>
<!--导航栏结束 -->

<!--退出提示-->
<div class="toast" id="toast-exit" style="position:fixed;width:100%;height:69px;z-index:100;display:none;">
  <label class="toast-label" style="font-family:微软雅黑;color:#ffffff;position:absolute;left:10%;line-height:45px;">你你你你你你你~真的要退出吗w</label>
  <button class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:55px;font-size:16px;cursor:pointer;" onclick="window.location.href='logout.php'">是的</button>
  <button id="cancelexit" class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:55px;font-size:16px;font-weight:bold;cursor:pointer;">不是</button>
</div>
<!--全局通知-->
<div id="globalnote">
<h3>最高指示</h3>
<p style="height:200px;width:80%;position:relative;left:10%;overflow-y:auto;word-wrap: break-word;">SUsage将于北京时间2016年8月17日凌晨3：01进行升级，期间所有服务将不可用。请尚在使用的同志们注意保存好自己的工作以防丢失。<br><br>这个engineering drawing呢，我们就有几年用鸭嘴的笔，旁边一个小盒子。最痛苦的，就是鸭嘴笔把这个水弄到里面，描图的时候一下子就⋯然后就用刀片刮，这个就是描图是最痛苦的，而且这个效率efficiency⋯
我的这个经历就是到了上海，到了89年的年初的时候，我在想我估计是快要离休了，我想我应该去当教授。于是我就给朱物华校长、张钟俊院长，给他们写了一个报告。他们说欢迎你来，不过，他这个Apply for Professor，那你要去做一个报告。我就做了一个能源与发展趋势的主要的节能措施，这个报告经过好几百个教授一致通过。那么上海交大教授当了以后我就做第二个报告，就是微电子工业的发展。这两个报告做了以后不久，过后，1989年的5月31号北京就把我调到北京去了。现在这个报告做了快20年了，所以呢我就去年呢在我们交大的学报，我发表了两篇文章，就是呼应这个89年的报告的。特别是昨天晚上，他又把我这个第二篇报告，还有我这十几年包括在电子工业部、上海市所做的有关于信息产业化的文章，总共我听他们讲是27篇。我也没有什么别的东西送给你们，我们拿来以后我叫钱秘书啊，就把这两个学报，两个学报的英文本，因为他们这里洋文好的人多得很呐，英文本，还有前面出过两本书，再加上昨天晚上出的这本书，送给郭伟华同志，给你送过来，那么给你们作为一个纪念。
人呐就都不知道，自己就不可以预料。你一个人的命运啊，当然要靠自我奋斗，但是也要考虑到历史的行程，我绝对不知道，我作为一个上海市委书记怎么把我选到北京去了，所以邓小平同志跟我讲话，说“中央都决定啦，你来当总书记”，我说另请高明吧。我实在我也不是谦虚，我一个上海市委书记怎么到北京来了呢？但是呢，小平同志讲“大家已经研究决定了”，所以后来我就念了两首诗，叫“苟利国家生死以，岂因祸福避趋之”，那么所以我就到了北京。
到了北京我干了这十几年我也没有什么别的，大概三件事：
一个，确立了社会主义市场经济；
第二个，把邓小平的理论列入了党章；
第三个，就是我们知道的“三个代表”。
如果说还有一点什么成绩就是军队一律不得经商！这个对军队的命运有很大的关系。因为我后来又干了一年零八个月，等于我在部队干了15年军委主席。还有九八年的抗洪也是很大的。但这些都是次要的，我主要的我就是三件事情，很惭愧，就做了一点微小的工作，谢谢大家。
这是我用过的啊！？老由啊，现在他们文印的图章里面绝对没有这枚图章，都不知道有这么一个东西。
这就是说明二院的档案工作做得太好了！
你们给我搞的这本东西啊……Excited！
</p>
<center><button class='btn fff' style="margin:20px 0 20px 0" onclick='closenote(); return false'>知道了啦</button></center>
</div>


<!-- 放在顶上的链接-->
<div id="about" class="ex-about" style="position:absolute;top:90px;width:100%;text-align:center;z-index:1;"><a href="ucenter.php#helper" target="_blank" style="color:#00C853">帮助与反馈中心 </a>·<a href="http://zhxsu.github.io/SUsage/" target="_blank" style="color:#00C853"> 关于 | 开源许可及协议声明 </a> <span class="trick" title="用鼠标刮这里看看">试试alt+shift+g</span> <a id="ver"></a> ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#9e9e9e">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#9e9e9e">电脑部</a> · In tech we trust 
</div>

<!-- 发布器以及任务界面 -->
<div id='poster' class='card rich-card'>
  <h3 style='font-family:微软雅黑;margin-top:5px;left:0px;font-size:16px;position:relative;margin-left:15px;line-height:20px'>发布任务( · ω · )<span style="position:relative;color:#FF0000;margin-top:5px;font-family:微软雅黑;font-size:12px;text-align:center">&#12288;本页面已禁用F5键以防止误触导致草稿丢失【千万别以为键盘坏了x——夏酱</span></h3>
  <div id='edtcontainer'>
    <textarea id='textarea1' style='position:inherit;border-radius:5px;height:390px;width:100%;padding:0px 0px 0px 0px;display:block'></textarea>
  </div>
  <div id='treecontainer' style='display:none'>
    <div style="z-index:999999;margin-top: 30px">
            <center style="line-height:10px;font-size: 13px;margin-bottom: 15px">请在下方的复选框勾选任务的接收组别。当此组别被勾选后，此组别下所有的成员将接收到该任务。</center>
      
      <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
        <input type="checkbox" id="checkNWB" name="ckdep[]" value="内务部">
        <label for="checkNWB" style="display:inline-block"></label>
        <span class="lablink">内务部</span>
      </div>
      
      <div class="checkbox" style="margin:15px 5% 0 5%;display:inline-block">
        <input type="checkbox" id="checkGGB" name="ckdep[]" value="公关部">
        <label for="checkGGB" style="display:inline-block"></label>
        <span class="lablink">公关部</span>
      </div>
                          
      <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
        <input type="checkbox" id="checkGBZ" name="ckdep[]" value="广播站">
        <label for="checkGBZ" style="display:inline-block"></label>
        <span class="lablink">广播站</span>
      </div>
      
      <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
        <input type="checkbox" id="checkAU" name="ckdep[]" value="社联">
        <label for="checkAU" style="display:inline-block"></label>
        <span class="lablink">社&#12288;联</span>
      </div>
      
      <div class="checkbox" style="margin:15px 5% 0 5%;display:inline-block;">
        <input type="checkbox" id="checkWYB" name="ckdep[]" value="文娱部">
        <label for="checkWYB" style="display:inline-block"></label>
        <span class="lablink">文娱部</span>
      </div>
      
      <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
        <input type="checkbox" id="checkXCB" name="ckdep[]" value="宣传部">
        <label for="checkXCB" style="display:inline-block"></label>
        <span class="lablink">宣传部</span>
      </div>
      
      <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block;">
        <input type="checkbox" id="checkXSB" name="ckdep[]" value="学术部">
        <label for="checkXSB" style="display:inline-block"></label>
        <span class="lablink">学术部</span>
      </div>
      
      <div class="checkbox" style="margin:15px 5% 0 5%;display:inline-block">
        <input type="checkbox" id="checkTYB" name="ckdep[]" value="体育部">
        <label for="checkTYB" style="display:inline-block"></label>
        <span class="lablink">体育部</span>
      </div>
      
      <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block">
        <input type="checkbox" id="checkZXT" name="ckdep[]" value="主席团">
        <label for="checkZXT" style="display:inline-block"></label>
        <span class="lablink">主席团</span>
      </div>
      <div>
        <h3 class="fi-subtitle">—————— 双电大法好 ——————</h3>
        <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block;">
        <input type="checkbox" id="checkDNB" name="ckdep[]" value="电脑部">
        <label for="checkDNB" style="display:inline-block"></label>
        <span class="lablink">电脑部</span>
      </div>
      
      <div class="checkbox" style="margin:15px 15% 0 15%;display:inline-block;">
        <input type="checkbox" id="checkDST" name="ckdep[]" value="电视台">
        <label for="checkDST" style="display:inline-block"></label>
        <span class="lablink">电视台</span>
      </div>
      
    </div>
  </div>
</div>

<button class='btn raised green' id='nextstep' onclick='fwd(); return false'>下一步</button>
<button class='btn raised green' id='backwardbutton' onclick='bwd(); return false' style='display:none'>上一步</button>
<button class='btn raised green' id='submit' style='display:none' onclick='GetTaskInfo();'>发布任务</button>
        
</div>
<p id="tips1">———— 你的任务 ————</p>
<div id="listarea">
		
<?php 
while($rs=mysqli_fetch_array($sql)){
  $name=$rs['pubman'];//发布人
  $pubdep=$rs['pubdep'];//发布部门
  $Tid=$rs['Taskid'];
  $info_sql="SELECT headimg FROM sys_user WHERE tname='$name'";
  $query=mysqli_query($conn,$info_sql);
  $info=mysqli_fetch_array($query);
  $headimg=$info['headimg'];//发布人头像
?>

<div class="card rich-card tasklist">
  <img class="headimg" src="<?php echo $headimg; ?>">
  <span class="name" ><?php echo $name; ?></span>
  <span class="pubgroup" ><?php echo $pubdep; ?></span>
  <span class="time">发布于<span><?php echo $rs['pubtime']; ?></span></span>
  <div class="contentarea">
    <p><?php echo $rs['ct']; ?></p>
  </div>
  
  <div class="card-footer">
  <?php
    $tname=$_SESSION['truename'];
    if($name==$tname){//自己发布的任务
      $cpt_sql="SELECT * FROM task_complete WHERE Taskid='$Tid' AND isComplete='1'";
      $cpt_rs=mysqli_query($conn,$cpt_sql);
      $cpt=mysqli_num_rows($cpt_rs);
      echo "<a class='del btn raised raised red' href='../functions/toDelTask.php?Tid=$Tid'>删除此任务</a>";
      echo "<a class='finishsum' href=''><span class='sumsty'>$cpt</span>人完成了你的任务</a>";
    }else{
      echo "<button class='btn raised mark blue'>标记为完成！</button>";
    }
  ?>
    
  </div>
</div>
<?php } ?>	

<center class="ex-end" style="left:12%">——————再怎么找都没有啦~——————</center>
</div>
		



<!--脚本引用-->
<script src="../res/js/jquery-2.2.1.min.js"></script>
<script src="../res/js/wangEditor.js"></script>
<script src="../res/js/basic.js"></script>
<script src="../res/js/GetCodeVer.js"></script>


<script type="text/javascript">
var editor = new wangEditor('textarea1');
var submitbtn = document.getElementById('nextstep');

editor.onchange = function(){
  if(this.$txt.html()=="<p><br></p>"){
    submitbtn.style.display = 'none';
  }else{
    submitbtn.style.display = 'block';
  }
};

editor.create();

function GetTaskInfo(){
  //获取用户信息
  var pubman="<?php echo $pubman; ?>";
  var pubdep="<?php echo $group; ?>";
  //获取任务内容
  var html=editor.$txt.html();
  //获取任务发布对象部门
  var dep="";
  ckdep=document.getElementsByName("ckdep[]");
  for(var i=0,j=ckdep.length;i<j;i++){
    if(ckdep[i].checked){
      dep += ckdep[i].value;
      dep += ",";
    }
  }
  //去除末尾的逗号
  dep = dep.substr(0,dep.length-1);
  PublishTask(pubman,pubdep,html,dep);
}

//页面启动时隐藏下一步按钮
window.onload=function(){
  submitbtn.style.display='none';
}

//彩蛋--关于我们  
function easteregg(){
  if(event.altKey && event.shiftKey && event.keyCode == 71){
    window.location.href="about.html";
  }
}

//关闭全局通知窗口
function closenote(){
	$("#globalnote").addClass("animate fadeOutUp");
	
}

var iptbox = document.getElementById('edtcontainer');
var treebox = document.getElementById('treecontainer');
var fwdbtn = document.getElementById('nextstep');
var bwdbtn = document.getElementById('backwardbutton');
var pstbtn = document.getElementById('submit');
function bwd(){
  treebox.style.display = 'none';
  iptbox.style.display = '';
  bwdbtn.style.display = 'none';
  fwdbtn.style.display = '';
  pstbtn.style.display = 'none';
}
function fwd(){
  treebox.style.display = 'block';
  iptbox.style.display = 'none';
  bwdbtn.style.display = 'block';
  fwdbtn.style.display = 'none';
  pstbtn.style.display = 'block';
}
</script>

<?php
if($_SESSION['SUmaster']==1){
  echo "<script src='../res/js/lockkey.js'></script>";
  echo '<script type="text/javascript">document.onkeydown = function(){lockf5();easteregg();};</script>';
}else{
  echo '<script type="text/javascript">document.onkeydown = function(){easteregg();};</script>';
}
?>

<script>
function PublishTask(man,pdep,ct,dep){
$.ajax({
  url:"../functions/toPublishTask.php",
  type:"POST",
  data:{pubman:man,pubdep:pdep,ct:ct,dep:dep},
  error:function(e){alert("发布任务失败！");},
  success:function(g){
    alert("发布任务成功！"+g);
    history.go(0);
  }
});
}
</script>

</body>
</html>

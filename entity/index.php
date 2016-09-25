<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/CheckLogged.php");
include("../functions/NightShift.php");
include("../functions/SO_API.php");

$UID=GetSess('userid');
$pubman=GetSess('truename');
$dep=array();
$dep=GetSess('dep');
$sql="SELECT * FROM task_list WHERE pubman='{$pubman}'";
for($i=0;$i<sizeof($dep);$i++){
 $sql.=" OR redep LIKE '%{$dep[$i]}%'";
}
$sql.=" ORDER BY Taskid DESC";
$sql=mysqli_query($conn,$sql);

$all=file_get_contents("../GlobalNotice.json");
$all=json_decode($all);
$Notice=urldecode($all->notice);
$Notice_man=$all->pubman;
$Notice_time=$all->pubtime;

$CSSPath=array("themes","editor","modules","modules");
$CSSName=array("Sinterface","wangEditor","ex-united");

if($_SESSION['SU_M']==1){
	array_push($CSSName,"ex-index-master");
}else{
	array_push($CSSName,"ex-index-normal");
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<title>你的任务 / SUsage Tasklist</title>
		<link rel="shortcut icon" href="../res/icons/title/task_128X128.ico"/>
		<?php ShowCSS($CSSPath,$CSSName); ?>	
	</head>
	
	<body style="position:absolute;width:80%;">
	<?php ShowNavbar(); ?>
		<!-- [begin]全局通知 -->
		<div id="globalnote" class="modhide">
			<h3>最高指示</h3>
			<p style="height:130px;width:80%;font-size:14px;position:relative;left:10%;overflow-y:auto;word-wrap:break-word;">
			发布人：<?php echo $Notice_man; ?>&#12288;&#12288;
			发布时间：<?php echo $Notice_time; ?><br>
			<span style="font-family: 'microsoft yahei'">——————————————————————</span><br>
			<!--内容区域开始-->
			<?php echo $Notice; ?>
			<!--内容区域结束-->
			<br>
			<span style="font-family: 'microsoft yahei'">————————以下空————————</span>
			</p>
			<center><button class='btn fff' style="margin:10px 0 20px 0" onclick='closenote(); return false'>知道了啦</button></center>
		</div>
		<!--[end]全局通知-->

		<div id="panel">
		<!-- 放在顶上的版权声明-->
		<div id="about" class="ex-about" style="position:absolute;top:90px;width:100%;text-align:center;z-index:1;">
			<a href="" onclick="opennote() ;return false" style="background-color:#c90000;color: #fff;padding:1px 5px 1px 5px;border-radius:15px"><span><?php echo $Notice_time; ?></span>最高指示</a>&#12288;
			<a href="UCenter.php#helper" target="_blank" style="color:#00C853">帮助与反馈中心 </a><!--·<a href="http://zhxsu.github.io/SUsage/" target="_blank" style="color:#00C853"> 关于 | 开源许可及协议声明 </a>--> <span class="trick" title="用鼠标刮这里看看">试试alt+shift+g</span> <a id="ver"></a><span class="tohide"> ©2016 <a href="http://weibo.com/zxsu32nd" target="_blank" style="color:#9e9e9e">执信学生会</a> <a href="http://weibo.com/zhxsupc" target="_blank"  style="color:#9e9e9e">电脑部</a> · In tech we trust </span>
		</div>
		
		<!-- 发布器以及任务界面 -->
		<div id='poster' class='card rich-card'>
			<h3 style='font-family:微软雅黑;margin-top:5px;left:0px;font-size:16px;position:relative;margin-left:15px;line-height:20px;color:#bbb'>发布任务( · ω · )<span class="tohide" style="position:relative;color:#FF0000;margin-top:5px;font-family:微软雅黑;font-size:12px;text-align:center">&#12288;本页面已禁用F5键以防止误触导致草稿丢失【千万别以为键盘坏了x——夏酱</span></h3>
			<div id='edtcontainer'>
				<textarea id='textarea1' style='position:inherit;border-radius:5px;height:390px;width:100%;padding:0px 0px 0px 0px;display:block'></textarea>
			</div>
			<div id='treecontainer' style='display:none'>
				<div style="z-index:999999;margin-top: 5px">
					<center style="line-height:12px;font-size: 13px;margin-bottom: 15px">当部门对应的复选框被勾选后，此部门下所有的成员将接收到该任务。</center>
					<div>					
						<div class="checkbox m">
							<input type="checkbox" id="CheckAll" onclick="CheckAll()">
							<label for="CheckAll" style="display:inline-block"></label>
							<span class="lablink">全&#12288;选</span>
						</div>
						<div class="checkbox m">
							<input type="checkbox" id="checkDNB" name="ckdep[]" onclick="CheckClick()" value="电脑部">
							<label for="checkDNB" style="display:inline-block"></label>
							<span class="lablink">电脑部</span>
						</div>
						<div class="checkbox m">
							<input type="checkbox" id="checkDST" name="ckdep[]" onclick="CheckClick()" value="电视台">
							<label for="checkDST" style="display:inline-block"></label>
							<span class="lablink">电视台</span>
						</div>					
					</div>
					<div class="checkbox m">
						<input type="checkbox" id="checkNWB" name="ckdep[]" onclick="CheckClick()" value="内务部">
						<label for="checkNWB" style="display:inline-block"></label>
						<span class="lablink">内务部</span>
					</div>
					<div class="checkbox m">
						<input type="checkbox" id="checkGGB" name="ckdep[]" onclick="CheckClick()" value="公关部">
						<label for="checkGGB" style="display:inline-block"></label>
						<span class="lablink">公关部</span>
					</div>
					<div class="checkbox m">
						<input type="checkbox" id="checkGBZ" name="ckdep[]" onclick="CheckClick()" value="广播站">
						<label for="checkGBZ" style="display:inline-block"></label>
						<span class="lablink">广播站</span>
					</div>
					<div class="checkbox m">
						<input type="checkbox" id="checkAU" name="ckdep[]" onclick="CheckClick()" value="社联">
						<label for="checkAU" style="display:inline-block"></label>
						<span class="lablink">社&#12288;联</span>
					</div>
					<div class="checkbox m">
						<input type="checkbox" id="checkWYB" name="ckdep[]" onclick="CheckClick()" value="文娱部">
						<label for="checkWYB" style="display:inline-block"></label>
						<span class="lablink">文娱部</span>
					</div>
					<div class="checkbox m">
						<input type="checkbox" id="checkXCB" name="ckdep[]" onclick="CheckClick()" value="宣传部">
						<label for="checkXCB" style="display:inline-block"></label>
						<span class="lablink">宣传部</span>
					</div>
					<div class="checkbox m">
						<input type="checkbox" id="checkXSB" name="ckdep[]" onclick="CheckClick()" value="学术部">
						<label for="checkXSB" style="display:inline-block"></label>
						<span class="lablink">学术部</span>
					</div>
					<div class="checkbox m">
						<input type="checkbox" id="checkTYB" name="ckdep[]" onclick="CheckClick()" value="体育部">
						<label for="checkTYB" style="display:inline-block"></label>
						<span class="lablink">体育部</span>
					</div>
					<div class="checkbox m">
						<input type="checkbox" id="checkZXT" name="ckdep[]" onclick="CheckClick()" value="主席团">
						<label for="checkZXT" style="display:inline-block"></label>
						<span class="lablink">主席团</span>
					</div>
				</div>
			</div>
			<button class='btn raised green' id='nextstep' onclick='gotoNextStep(); return false'>下一步</button>
			<button class='btn raised green' id='laststep' onclick='gotoLastStep(); return false' style='display:none'>上一步</button>
			<button class='btn raised green' id='submit' style='display:none' onclick='GetTaskInfo();'>发布任务</button>
		</div>
		<!-- [begin]任务界面 -->
		<p id="tips1" class="tohide">———— 你的任务 ————</p>
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
				<span class="name"><?php echo $name; ?></span>
				<span class="pubgroup"><?php echo $pubdep; ?></span>
				<span class="time">发布于<span><?php echo $rs['pubtime']; ?></span></span>
				<div class="contentarea">
				  <?php echo $rs['ct']; ?>
				</div>
				<div class="card-footer">
				<?php
				if($name==$pubman){//自己发布的任务
					$cpt_sql="SELECT * FROM task_complete WHERE Taskid='$Tid' AND isComplete='1'";
					$cpt_rs=mysqli_query($conn,$cpt_sql);
					$cpt=mysqli_num_rows($cpt_rs);
				?>
				<div id='click<?php echo $Tid;?>'><a class='del btn raised red' onclick='checkDel("<?php echo $Tid; ?>");'>删除此任务</a></div>
				<div id='check<?php echo $Tid;?>' style='display:none'><a class='del btn raised redmore' onclick='DeleteTask("<?php echo $Tid; ?>");'>确认删除</a></div>
				<a class='finishsum' onclick='opencpt("<?php echo $Tid; ?>");'>已有<span class='sumsty'><?php echo $cpt; ?></span>人完成</a>
				<?php 
				}else{
    $cpt_sql="SELECT * FROM task_complete WHERE Taskid='$Tid' AND Userid='$UID'";
    $cpt_query=mysqli_query($conn,$cpt_sql);
				     $cpt_rs=mysqli_fetch_array($cpt_query);
    if($cpt_rs["isComplete"]=="0"){
				 ?>
				<div id="cptClick<?php echo $Tid; ?>"><button class='btn raised mark green' onclick='checkcpt("<?php echo $Tid; ?>");'>完成任务</button></div>
				<div id="cptCheck<?php echo $Tid; ?>" style="display:none;" onclick='CompleteTask("<?php echo $Tid; ?>");'><button class='btn raised mark greenmore'>确认完成</button></div>
        <?php }else{ ?>
    			<div style="color:#4fb4f7;float:right;margin:10px"><span style="background-color:#00c857;color: #fff;padding:1px 5px 0 5px;border-radius:15px">√</span> 你已经完成任务</div>
        <?php } } ?>
        </div>
      </div>
      <?php } ?>
      <center class="ex-end" style="left:12.8%">——————再怎么找都没有啦~——————</center>
      </div>
    </div>
		<!-- [begin]任务完成模块 -->
		<div id="whofinished" class="modhide">
			<h3><div id="PeopleNum"></div></h3>
			<div style="height:230px;width:80%;position:relative;left:10%;overflow-y:auto" id="Showing"></div>
			<center><button class='btn fff' style="margin:10px 0 20px 0" onclick='closecpt(); return false'>好，可以，行</button></center>
		</div>

<!--脚本引用-->
<?php 
$JSName=array("jquery-2.2.1.min","wangEditor","basic","GetCodeVer","easteregg");
ShowJS($JSName);
?>
<script src="../functions/Task/TaskAjax.js"></script>

<script type="text/javascript">
var editor = new wangEditor('textarea1');
var submitbtn = document.getElementById('nextstep');
var ckdep = document.getElementsByName("ckdep[]");
var cl = ckdep.length;

//页面自启动:启动头像动画,隐藏下一步按钮
window.onload=function(){
	submitbtn.style.display='none';
	$("#hdimg").addClass('animate rubberBand');
	setTimeout("$('#namebox').addClass('animate bounceIn');", 400);
}

function CheckAll(){
var Checking = document.getElementById("CheckAll");
  if(Checking.checked){
    for(i=0;i<cl;i++){
      ckdep[i].checked = true;
      pstbtn.style.display = 'block';
    }
  }else{
    for(i=0;i<cl;i++){
      ckdep[i].checked = false;
      pstbtn.style.display = 'none';
    }
  }
}

function CheckClick(){
var Checking = document.getElementById("CheckAll");
NotCheck=0;isCheck=0;

for(var k=0;k<cl;k++){
 if(ckdep[k].checked){
   pstbtn.style.display = 'block';
   isCheck++;
 }else if(!ckdep[k].checked){
   NotCheck++;
   Checking.checked=false;
 }
}
if(isCheck==cl){
 Checking.checked=true;
}
if(NotCheck==cl){
  pstbtn.style.display = 'none';
}
}
 
editor.onchange = function(){
	if(this.$txt.html()=="<p><br></p>"){
		submitbtn.style.display = 'none';
	}else{
		submitbtn.style.display = 'block';
	}
};

editor.create();

//确认删除任务，切换按钮
function checkDel(tid){
	document.getElementById('click'+tid).style.display = "none";
	document.getElementById('check'+tid).style.display = "";
}

//确认完成任务，切换按钮
function checkcpt(tid){
	document.getElementById('cptClick'+tid).style.display = "none";
	document.getElementById('cptCheck'+tid).style.display = "";
}

function GetTaskInfo(){
	//获取任务内容
	var html=editor.$txt.html();
	//获取任务发布对象部门
	var dep="";
	for(i=0;i<cl;i++){
	 if(ckdep[i].checked){
		  dep += ckdep[i].value;
		  dep += ",";
	 }
 }
 //去除末尾的逗号
 dep = dep.substr(0,dep.length-1);
 PublishTask(html,dep);
}

function opennote(){	
	$("#globalnote").removeClass("modhide");
	$("#globalnote").addClass("moddisplay");
	$("#globalnote").addClass("animate fadeInDown");
}
//关闭全局通知窗口
function closenote(){
	$("#globalnote").removeClass("fadeInDown");
	$("#globalnote").addClass("animate fadeOutUp");
	$("#globalnote").addClass("modhide");
}

//关闭WFD窗口
function closecpt(){
	$("#whofinished").removeClass("fadeInDown");
	$("#whofinished").addClass("fadeOutUp");
	$("#whofinished").addClass("modhide");
	$("#panel").removeClass("disablemod");
}
//打开WFD窗口
function opencpt(Taskid){
	GetWhoFinished(Taskid);
}

//发布器的切换
var iptbox = document.getElementById('edtcontainer');
var treebox = document.getElementById('treecontainer');
var nextbtn = document.getElementById('nextstep');
var lastbtn = document.getElementById('laststep');
var pstbtn = document.getElementById('submit');
			
function gotoLastStep(){
	treebox.style.display = 'none';
	iptbox.style.display = '';
	lastbtn.style.display = 'none';
	nextbtn.style.display = '';
	pstbtn.style.display = 'none';
}

function gotoNextStep(){
	treebox.style.display = 'block';
	iptbox.style.display = 'none';
	lastbtn.style.display = '';
	nextbtn.style.display = 'none';
	pstbtn.style.display = 'none';
}
</script>

<?php
if($_SESSION['SU_M']==1){
	echo "<script src='../res/js/lockkey.js'></script>";
	echo '<script type="text/javascript">document.onkeydown = function(){lockf5();easteregg();};</script>';
}else{
	echo '<script type="text/javascript">document.onkeydown = function(){easteregg();};</script>';
}
?>
</body>
</html>
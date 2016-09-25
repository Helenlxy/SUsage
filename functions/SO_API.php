<?php

/**
* @name PHP公用函数库 -- 底层基础函数
* @copyright 版权所有：小生蚝 <master@xshgzs.com>
* @create 创建时间：2016-04-07
* @modify 最后修改时间：2016-08-27
*/


/* Require Package <Database> */
require_once("to_sql.php");
/* Require Package <Showing> */
require_once("Func/Show.func.php");
/* Require Package <Session> */
require_once("Func/Session.func.php");
/* Require Package <User Privacy> */
require_once("Func/Privacy.func.php");


/**
* ------------------------------
* toAlertDie 弹框并die
* ------------------------------
* @param String 自定义错误码
* @param String 可选，自定义提示内容
* ------------------------------
**/
function toAlertDie($ErrorNo,$Tips="",$isInScript="")
{
 if($isInScript=="Ajax"){
  $Alerting=$ErrorNo."\n".$Tips;
  $ErrorNo="";
 }else if($isInScript==0 || $isInScript==""){
 $Alerting='<script>alert("Oops！系统处理出错了！\n\n错误码：'.$ErrorNo.'\n'.$Tips.'");</script>';
 }else if($isInScript==1){
  $Alerting='alert("Oops！系统处理出错了！\n\n错误码：'.$ErrorNo.'\n'.$Tips.'");';
 } 
 die($Alerting.$ErrorNo);
}


/**
* ------------------------------
* random 获取随机数
* ------------------------------
* @param int 随机数的长度，直接输入数字
* @param PW  随机串类型，用作特殊处理
* ------------------------------
* @return STR 随机数的结果
**/
function random($len,$type=""){
  
  $random="";$id="";
  if($type=="pw"){
    $id=mt_rand(104672,891753);
  }
  
  $ranstr="1S9D5G4E8W7P0RVL2DKQ1BXU3Y6";
  for($i=0;$i<$len;$i++){
    $random.=$ranstr[mt_rand(0,26)];
  }
  
  $ran=$id.$random;
  return $ran;
}


/**
* ------------------------------
* checkPW 检查密码是否有效
* ------------------------------
* @param String 需要检查的密码
* ------------------------------
* @return String 无效密码数量|密码共有类型
**/
function checkPW($pw){
$allowstr="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890^*:~?+/,.";
//pwlen密码长度，falsestr违规字符数，num字符类型数
$pwlen=strlen($pw);$falsestr=0;$num=0;$pwtype=array();
//检查是否符合密码字符规定
for($i=0;$i<$pwlen;$i++){
 $nowstr=substr($pw,$i,1);
 $bl=strstr($allowstr,$nowstr);
 if($bl==false){
  $falsestr++;
 }else{
  //统计共有多少种类型
  if(strstr("0123456789",$nowstr)){
   $pwtype[0]=1;
  }else if(strstr("QWERTYUIOPASDFGHJKLZXCVBNM",$nowstr)){
   $pwtype[1]=1;
  }else if(strstr("qwertyuiopasdfghjklzxcvbnm",$nowstr)){
   $pwtype[2]=1;
  }else if(strstr("^*:~?+/,.",$nowstr)){
   $pwtype[3]=1;
  }
 }
}

foreach($pwtype as $value){
 if(strstr($value,"1")) $num++;
}

if($num>=3) $ret=1;
else $ret=0;
return $falsestr."|".$ret;
}


/**
* ------------------------------
* GetIP 获取随机数
* ------------------------------
* @return String 当前终端的IP
**/
function GetIp(){
$ip=false;
if(!empty($_SERVER["HTTP_CLIENT_IP"])){
  $ip = $_SERVER["HTTP_CLIENT_IP"];
}

if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
  if($ip){
    array_unshift($ips, $ip);
    $ip = FALSE;
  }
  for($i = 0; $i < count($ips); $i++){
    if(!eregi("^(10|172\.16|192\.168)\.",$ips[$i])){
      $ip = $ips[$i];
      break;
    }
  }
}
return $ip?$ip:$_SERVER['REMOTE_ADDR'];
}


/**
* ------------------------------
* MC_auth 后台用户检测是否有访问模块权限
* ------------------------------
* @param String 当前模块名称
* @param 0/1    是否管理员
* @param 0/1    是否超级管理员
* @param 0/1    是否根用户
* ------------------------------
* @return 0/1 是否有权限访问当前模块
* ------------------------------
**/
function MC_auth($name,$a,$s,$r){
if($r=="1") return "1";
if($s=="1" && $name=="B")return "0";

//U_A:新增用户,U_E:编辑用户资料,U_R:重置用户密码,U_P:用户角色分配,L_L:登录记录,B:账务模块
$purvA=array("U_A","U_E","B");
$purvS=array("U_A","U_E","U_R","U_P","L_L");
$inarrS=in_array($name,$purvS);
$inarrA=in_array($name,$purvA);

if($s=="1" && $inarrS=true) return "1";
else if($a=="1" && $inarrA=true) return "1";
else return "0";
}

?>
<?php

//PHP后端公用函数库
//共有函数：4个
//库版本：V0.4

//版权所有：小生蚝
//创建时间：2016-04-03
//最后修改时间：2016-08-19


/**
* ------------------------------
* random 获取随机数
* ------------------------------
* @param len 随机数的长度，直接输入数字
* @param type 类型，可选(pw)，用作特殊处理
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
* @param pw 需要检查的密码
* ------------------------------
* @return STR 无效密码的数量|密码共有类型
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
  if(preg_match("/^[0-9]*$/",$nowstr)){
   $pwtype[0]=1;
  }else if(preg_match("/^[A-Za-z]+$/",$nowstr)){
   $pwtype[1]=1;
  }else{
   if(strstr("^*:~?+/,.",$pw)){
    $pwtype[2]=1;
   }
  }
 }
}

foreach($pwtype as $value){
 if(strstr($value,"1")) $num++;
}

if($num>=2) $ret=1;
else $ret=0;
return $falsestr."|".$ret;
}


/**
* ------------------------------
* ShowNavbar 显示前台导航栏
* ------------------------------
**/
function ShowNavbar(){
 include("../functions/ShowNav.php");
}


/**
* ------------------------------
* GetIP 获取随机数
* ------------------------------
* @return STR 当前终端的IP
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


function MC_auth($name,$a,$s,$r){
if($r=="1") return "1";
if($s=="1" && $name=="B")return "0";

$purvA=array("U_A","U_E","U_R","B");
$purvS=array("U_A","U_E","U_R","U_P");
$inarrS=in_array($name,$purvS);
$inarrA=in_array($name,$purvA);
if($s=="1" && $inarrS=true) return "1";
else if($a=="1" && $inarrA=true) return "1";
else return "0";

}
?>
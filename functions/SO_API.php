<?php

//PHP后端公用函数库
//共有函数：1个
//库版本：V0.1

//版权所有：小生蚝
//创建时间：2016-04-03
//最后修改时间：2016-05-28


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


?>
<?php

/**
* @name PHP公用函数库 -- Session操作函数
* @copyright 版权所有：小生蚝 <master@xshgzs.com>
* @create 创建时间：2016-08-28
* @modify 最后修改时间：2016-08-28
*/

/**
* -------------------------------------
* SetSess 设置Session
* -------------------------------------
* @param Array Session名称
* @param Array 对应Session值
* -------------------------------------
**/
function SetSess($SessName,$SessValue)
{
 if(!is_array($SessName)){toAlertDie("211");}
 if(!is_array($SessValue)){toAlertDie("212");}
 $TotalName=sizeof($SessName);
 $TotalValue=sizeof($SessValue);
 if($TotalName != $TotalValue){
  toAlertDie("213");
 }
 for($i=0;$i<$TotalName;$i++){
  $_SESSION[$SessName[$i]]=$SessValue[$i];  
 }
}


/**
* -------------------------------------
* GetSess 获取Session值
* -------------------------------------
* @param String 要取值的Session名
* -------------------------------------
* @return String 对应Session值
* -------------------------------------
**/
function GetSess($SessName)
{
 if(!$_SESSION[$SessName]){toAlertDie("221");}
 return $_SESSION[$SessName];
}

?>
<?php

/**
* @name PHP公用函数库 -- 显示文件函数
* @copyright 版权所有：小生蚝 <master@xshgzs.com>
* @create 创建时间：2016-08-27
* @modify 最后修改时间：2016-08-27
*/


/**
* ------------------------------
* ShowNavbar 显示前台导航栏
* ------------------------------
**/
function ShowNavbar()
{
 include("../functions/ShowNav.php");
}


function ShowCSS($Path,$FileName)
{
 //两个变量的类型检测
 if(!is_array($Path) && is_array($FileName)){die("111");}
 if(is_array($Path) && !is_array($FileName)){die("112");}
 
 //如果不是Array
 if(!is_array($Path) && !is_array($FileName)){
  echo "<link rel='stylesheet' href='../res/css/$Path/$FileName.css'>";
 }
 
 else if(is_array($Path) && is_array($FileName)){
  $TotalPath=sizeof($Path);
  $TotalName=sizeof($FileName);
  
  //判断两个Array元素数量是否相同
  if($TotalPath != $TotalName){
   die("113");
  }
  
  for($i=0;$i<$TotalPath;$i++){
   echo "<link rel='stylesheet' href='../res/css/$Path[$i]/$FileName[$i].css'>";
  }
 }
}


function ShowJS($FileName)
{
 //如果不是Array
 if(!is_array($FileName)){
  echo "<script src='../res/js/$FileName.js'></script>";
 }
 
 else if(is_array($FileName)){
  $TotalName=sizeof($FileName);
  
  for($i=0;$i<$TotalName;$i++){
   echo "<script src='../res/js/$FileName[$i].js'></script>";
  }
 }
}
?>
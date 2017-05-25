<?php

/**
* @name PHP公用函数库 3 系统隐私函数
* @copyright 版权所有：小生蚝 <master@xshgzs.com>
* @create 创建时间：2016-08-28
* @modify 最后修改时间：2016-08-29
*/

/**
* -------------------------------------
* AddLoginLog 新增登录记录
* -------------------------------------
* @param Array    数据库连接变量
* @param S|M      系统前台/后台
* @param String   用户真实姓名
* @param String   用户输入的密码
* @param String   用户浏览器UA
* @param 0/1/M/6  是否登录成功
* @param String   SessionID
* @param String   用户IP
* -------------------------------------
**/
function AddLoginLog($conn,$Where,$User,$Password,$UserAgent,$Status,$SessID,$IP)
{
 $pw=base64_encode($Password);
 $rs=mysqli_query($conn,"INSERT INTO sys_login_log SET UserName='{$User}', Password='{$pw}', UserAgent='{$UserAgent}', IPAddress='{$IP}', SessionID='{$SessID}'");
 if($rs==true){return;}
 else if($rs==false){
  if($Where=="Q"){
   toAlertDie("311","请截图并提交至App组：".mysqli_error($conn),"Ajax");
  }else{
   toAlertDie("311","请截图并提交至App组：".mysqli_error($conn));
  }
 }
}

?>
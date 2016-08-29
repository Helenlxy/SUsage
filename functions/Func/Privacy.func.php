<?php

function AddLoginLog($conn,$User,$Password,$UserAgent,$SessID,$IP)
{
 $rs=mysqli_query($conn,"INSERT INTO sys_login_log SET UserName='{$User}', Password='{$Password}', UserAgent='{$UserAgent}', IPAddress='{$IP}', SessionID='{$SessID}'");
 if($rs==true){return "71";}
 else if($rs==false){return "72";}
}

function ResetPassword($conn,$UserName)
{
 $NewPassword=mt_rand(218196,985614);
 $HashNewPW=sha1($NewPassword);
 $rs=mysqli_query($conn,"UPDATE sys_user SET pw='{$HashNewPW}'");
 return $NewPassword;
}
?>
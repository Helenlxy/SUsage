<?php
if(isset($_POST) && $_POST){
  $pw=$_POST['pw'];
  $SHA1=sha1($pw);
  echo "PW:".$pw."<br><br>";
  echo "INDB:".$SHA1;
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf8">
<form method="post">
请输入密码：<input name="pw"><br>
<input type="submit" value="确认加密" width="90%">
</form>
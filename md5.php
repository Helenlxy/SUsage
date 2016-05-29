<?php
include("functions/SO_API.php");
if(isset($_POST) && $_POST){
  $pw=$_POST['pw'];
  $salt=random(6);
  $md5=md5($pw.$salt);
  echo "PW:".$pw."<br><br>";
  echo "Salt:".$salt."<br><br>";
  echo "INDB:".$md5;
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<form method="post">
<input name="pw">
<input type="submit">
</form>
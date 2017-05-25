<?php

function ChangeStr($str){
switch($str){
  case 'q':$str=str_replace("q","z",$str);break;
  case 'h':$str=str_replace("h","a",$str);break;  
  case 'e':$str=str_replace("e","p",$str);break;
  case 'r':$str=str_replace("r","x",$str);break;
  case 't':$str=str_replace("t","m",$str);break;
  case 'y':$str=str_replace("y","d",$str);break;
  case 'a':$str=str_replace("a","h",$str);break;
  case 'f':$str=str_replace("f","w",$str);break;
  case 'u':$str=str_replace("u","j",$str);break;
  case 'i':$str=str_replace("i","o",$str);break;
  case 'z':$str=str_replace("z","q",$str);break;
  case 'o':$str=str_replace("o","i",$str);break;
  case 'p':$str=str_replace("p","e",$str);break;
  case 's':$str=str_replace("s","l",$str);break;
  case 'd':$str=str_replace("d","y",$str);break;
  case 'g':$str=str_replace("g","b",$str);break;
  case 'j':$str=str_replace("j","u",$str);break;
  case 'k':$str=str_replace("k","c",$str);break;
  case 'l':$str=str_replace("l","s",$str);break;
  case 'x':$str=str_replace("x","r",$str);break;
  case 'c':$str=str_replace("c","k",$str);break;
  case 'w':$str=str_replace("w","f",$str);break;
  case 'v':$str=str_replace("v","n",$str);break;
  case 'b':$str=str_replace("b","g",$str);break;
  case 'n':$str=str_replace("n","v",$str);break;
  case 'm':$str=str_replace("m","t",$str);break;
  
  case '0':$str=str_replace("0","8",$str);break;
  case '1':$str=str_replace("1","6",$str);break;
  case '2':$str=str_replace("2","4",$str);break;
  case '3':$str=str_replace("3","7",$str);break;
  case '4':$str=str_replace("4","2",$str);break;
  case '5':$str=str_replace("5","9",$str);break;
  case '6':$str=str_replace("6","1",$str);break;
  case '7':$str=str_replace("7","3",$str);break;
  case '8':$str=str_replace("8","0",$str);break;
  case '9':$str=str_replace("9","5",$str);break;
  
  case '^':$str=str_replace("^",".",$str);break;
  case '*':$str=str_replace("*","+",$str);break;
  case ':':$str=str_replace(":","/",$str);break;
  case '~':$str=str_replace("~",",",$str);break;
  case '?':$str=str_replace("?","?",$str);break;
  case '+':$str=str_replace("+","*",$str);break;
  case '/':$str=str_replace("/",":",$str);break;
  case ',':$str=str_replace(",","~",$str);break;
  case '.':$str=str_replace(".","^",$str);break;
}
return $str;
}

//加密
function SOCGS($cipher){
 for($a=0;$a<strlen($cipher);$a++){
  $cipher[$a]=ChangeStr($cipher[$a]);
 } 

$suger=(string)mt_rand(123456,789899);
 for($j=0;$j<6;$j++){
  $suger[$j]=ChangeStr($suger[$j]);
 }
 $Loc=$suger[0];
 
 if($Loc%2==0 && $Loc<=3){
  $KeySymbol="*";
 }else if($Loc%2!=0 && $Loc<5){
  $KeySymbol="@";
 }else{
  $KeySymbol="%";
 }
 
 $stra=substr($cipher,0,$Loc);
 $strb=substr($cipher,$Loc+1);
 
 $cipher=$stra.$KeySymbol.$suger.$strb;
 $cipher=base64_encode($cipher);
 return $cipher;
}

//检测
function SOCGS_Check($input,$cipher){
  $cipher=base64_decode($cipher);
  for($k=0;$k<strlen($input);$k++){
    $input[$k]=ChangeStr($input[$k]);
  }
  
  $Loc_Special=array(strpos($cipher,"*"),strpos($cipher,"@"),strpos($cipher,"%"));
  for($n=0;$n<3;$n++){
   if($Loc_Special[$n]>0){
    $suger=substr($cipher,$Loc_Special[$n],6);
    $ciphera=substr($cipher,0,$Loc_Special[$n]);
    $cipherb=substr($cipher,$Loc_Special[$n]+6);
   }
  }
  
  $verify=$ciphera.$suger.$cipherb;
  if($verify==$cipher) return "1";
  else return "0";
}

?>
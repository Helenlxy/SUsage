<?php
//Night Shift
$h=date('G');

if ($h<6 || $h>22) 
  echo '<link rel="stylesheet" href="../res/css/themes/night.css">';
else 
  echo '<link rel="stylesheet" href="../res/css/themes/day.css">';
?>
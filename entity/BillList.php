<?php
require_once("../functions/to_sql.php");
$query=mysqli_query($conn,"SELECT * FROM bill_list");
?>
<table width="100%">
<tr>
<th>账目名</th>
<th>内容</th>
<th>支出</th>
<th>收入</th>
<th>经手人</th>
</tr>
<?php
while($rs=mysqli_fetch_row($query)){
 echo "<tr>";
 for($i=1;$i<=5;$i++){
  echo "<td>".$rs[$i]."</td>";
 }
 echo "</tr>";
}
?>
</table>
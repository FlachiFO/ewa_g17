<?php 

$sql2="SELECT * FROM buecher";
$result = mysqli_query($db_con,$sql2);
//$row2 = mysqli_fetch_array($result, MYSQL_ASSOC);

for ($i = 0; $i < mysqli_num_rows($result) ; $i++) {
    $row2[$i] = mysqli_fetch_assoc($result);
}
?>


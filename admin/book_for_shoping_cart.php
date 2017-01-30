<?php

$bId = $_GET['id'];
$db_host = "localhost";
$db_name = "g17";
$db_user = "root";
$db_pass = "";

$db_con = mysqli_connect($db_host, $db_user, $db_pass,$db_name);

if (mysqli_stat ($db_con) === NULL)
    die("Error: Keine Verbindung möglich!");
mysqli_set_charset($db_con, 'utf8');

$sql2="SELECT * FROM buecher WHERE ProduktID =".$bId;
$result = mysqli_query($db_con,$sql2);
//$row2 = mysqli_fetch_array($result, MYSQL_ASSOC);

for ($i = 0; $i < mysqli_num_rows($result) ; $i++) {
    $row2[$i] = mysqli_fetch_assoc($result);
}
$result4 = $row2;
echo json_encode($result4);

?>
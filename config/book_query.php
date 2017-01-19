<?php 
	session_start();
	require_once 'db_config.php';

    if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $sql_book = "SELECT Produkttitel, Autorname, Verlagsname FROM buecher WHERE Produktitel LIKE '%{$query}%' OR Autorname LIKE '%{$query}%' OR Verlagsname LIKE '%{$query}%'";
    $result = mysqli_query($db_con,$sql_book);
     
}

?>
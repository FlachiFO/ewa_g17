<?php


	$db_host = "localhost";
	$db_name = "g17";
	$db_user = "root";
	$db_pass = "";
		
    $db_con = mysqli_connect($db_host, $db_user, $db_pass,$db_name);

    if (mysqli_stat ($db_con) === NULL)
        die("Error: Keine Verbindung möglich!");        


?>
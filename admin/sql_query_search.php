<?php

  $user = 'G17';
  $pass = 'oo43b';
    try {
        $conn = new PDO('mysql:host=localhost;dbname=g17', $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $querySearchTypes = $conn->prepare('SELECT * FROM buecher');
        $querySearchTypes->execute();

        $result = $querySearchTypes->fetchAll();
        echo json_encode($result);
    } catch(PDOException $e){
        echo $e;
    }


  
?>
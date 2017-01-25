<?php
  $user = 'G17';
  $pass = 'oo43b';
    
  $conn = new PDO('mysql:host=localhost;dbname=simio', $user, $pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $queryCustomerTypes = $conn->prepare('SELECT * FROM buecher');
  $queryCustomerTypes->execute();
  
  $result = $queryCustomerTypes->fetchAll();
  echo json_encode($result);
  
?>
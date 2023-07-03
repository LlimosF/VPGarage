<?php

$userdb = "root";
$pass = '';

try {

  $db = new PDO('mysql:host=localhost;dbname=database', $userdb, $pass);

} catch (PDOException $e) {

  print "Erreur :" . $e->getMessage() . "<br/>";
  die;
  
}

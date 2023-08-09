<?php

$userdb = "";
$pass = '';

try {

  $db = new PDO('mysql:host=;dbname=database', $userdb, $pass);

} catch (PDOException $e) {

  print "Erreur :" . $e->getMessage() . "<br/>";
  die;
  
}

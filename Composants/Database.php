<?php

$userdb = "llimos";
$pass = 'Titine19!';

try {

  $db = new PDO('mysql:host=mysql-llimos.alwaysdata.net;dbname=llimos_database', $userdb, $pass);

} catch (PDOException $e) {

  print "Erreur :" . $e->getMessage() . "<br/>";
  die;
  
}
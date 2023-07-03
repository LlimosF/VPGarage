<?php

$userdb = "root";
$pass = '';

try {
  $db = new PDO('mysql:host=localhost;dbname=database', $userdb, $pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Ajout de cette ligne pour afficher les erreurs SQL
} catch (PDOException $e) {
  print "Erreur :" . $e->getMessage() . "<br/>";
  die;
}
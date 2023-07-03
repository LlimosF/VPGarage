<?php

session_start();

  // Vérifier si l'utilisateur est connecté
  if (!isset($_SESSION["user"])) {
      // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
      header("Location: ../SousPages/Connexion.php");
      exit();
  }
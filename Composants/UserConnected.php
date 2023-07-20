<?php

session_start();

  // Check if the user is logged in

  if (!isset($_SESSION["user"])) {

      // Redirect to login page if user is not logged in

      header("Location: Connexion.php");
      exit();
  }
<?php

require("../Composants/Database.php");

ob_start();

require("Connexion.php");

ob_end_clean();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== 'Admin') {
  header("Location: ../Pages/modification.php");
  exit();
}

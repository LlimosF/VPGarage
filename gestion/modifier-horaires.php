<?php

require_once("../composants/utilisateur-connecte.php");

// Include the database

require_once("../composants/database.php");

// We include the header on the page

require_once("../composants/header-gestion.php");

// We include the background of the page

require_once("../composants/background-fixed.php");

// We include the navigation bar

require_once("../composants/navigation-gestion.php");

require_once("../composants/verifier-admin.php");

$sql = "SELECT * FROM horaires ORDER BY 'id' DESC";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

?>

<div>
  <div class="container-form">
    <?php
    
      require_once("../composants/horaire-lundi.php");

      require_once("../composants/horaire-mardi.php");

      require_once("../composants/horaire-mercredi.php");

      require_once("../composants/horaire-jeudi.php");

      require_once("../composants/horaire-vendredi.php");

      require_once("../composants/horaire-samedi.php");

      require_once("../composants/horaire-dimanche.php");

    ?>
  </div>
</div>
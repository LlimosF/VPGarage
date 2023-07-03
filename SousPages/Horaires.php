<?php

// Check that the user is logged in

require_once("../Composants/UserConnected.php");

// We include the header on the page

require_once ("../Composants/HeaderGestion.php");

// We include the bottom of the page

require_once("../Composants/BackgroundFixed.php");

// We include the navigation bar for management

require_once("../Composants/NavbarCustom.php");

// Include the database

require_once ("../Composants/Database.php");

// We check that only the admin can access this page

require_once("../Composants/VerifierAdmin.php");

// We retrieve our schedules from the database

$sql = "SELECT * FROM horaires ORDER BY 'id' DESC";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

?>

<div>
  <h2 class="big-title">Modification des horaires</h2>
  <div class="container-form">
    <?php
    
      // We collect all our forms for each day of the week

      // Monday
    
      require_once("../Composants/HoraireLundi.php");

      // Tuesday

      require_once("../Composants/HoraireMardi.php");

      // Wednesday

      require_once("../Composants/HoraireMercredi.php");

      // Thursday

      require_once("../Composants/HoraireJeudi.php");

      // Friday

      require_once("../Composants/HoraireVendredi.php");

      // Saturday

      require_once("../Composants/HoraireSamedi.php");

      // Sunday

      require_once("../Composants/HoraireDimanche.php");
    ?>
  </div>
</div>
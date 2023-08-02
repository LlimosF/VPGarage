<?php

// Include the header

require_once("../composants/header-gestion.php");

// We include the bottom of the page

require_once("../composants/background-fixed.php");

// Check if the user is logged in

require_once("../composants/utilisateur-connecte.php");

// Include the database

require_once("../composants/database.php");

// We include our navigation bar

require_once("../composants/navigation-gestion.php");

// Variable to track if an ad has been successfully removed

$annonceSupprimee = false;

// We check if the delete button has been clicked



?>
<div class="container-vente">

  <!-- We retrieve our vehicles that are already on sale from the database -->
  
  <?php
  $sql = "SELECT * FROM voitures ORDER BY id DESC";
  $requete = $db->query($sql);
  $voitures = $requete->fetchAll();

  foreach ($voitures as $voiture):
    $imageData = base64_encode($voiture['photo']);
    $imageType = 'jpeg';
  ?>

  <!-- We create our maps that contain the cars -->

  <div class="card-vente">
    <h3 class="title-card"><?= $voiture["nom"] ?></h3>
    <?php if (isset($voiture['photo']) && !empty($voiture['photo'])): ?>
      <img src="data:image/<?= $imageType ?>;base64,<?= $imageData ?>" alt="Image" class="car-img">
    <?php endif; ?>
    <hr class="separator">
    <p class="caracteristiques">Caractéristiques</p>
    <hr class="separator">
    <ul class="ul-vente">
      <li>Nom du véhicule : <?= $voiture["nom"] ?></li>
      <li>Kilométrage : <?= $voiture["kilometrage"] ?></li>
      <li>Année : <?= $voiture["annee"] ?></li>
      <li>Transmission : <?= $voiture["transmission"] ?></li>
      <li>Cylindrée : <?= $voiture["cylindre"] ?></li>
      <li>Chevaux : <?= $voiture["chevaux"] ?></li>
      <li>Prix : <?= $voiture["prix"] ?></li>
    </ul>

    <!-- Form to delete the ad -->

    <form method="POST">
      <button type="submit" name="delete" class="delete" value="<?= $voiture["id"] ?>">Supprimer l'annonce</button>
      <?php 
        if (isset($_POST["delete"])) {
          $idToDelete = $_POST["delete"];
      
          // We create the SQL query to delete a car
      
          $deletesql = "DELETE FROM voitures WHERE id = :id";
          $stmt = $db->prepare($deletesql);
          $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);
      
          if ($stmt->execute()) {
              $annonceSupprimee = true;

              echo "<h2 class='success'>Annonce supprimé !</h2>";
          } else {
      
            echo "<h2 class='error'>Erreur lors de la suppression de l'annonce !</h2>";
      
          }
      }
      ?>
    </form>
  </div>

  <?php endforeach; ?>

  <?php if ($annonceSupprimee): ?>

  <?php endif; ?>

</div>

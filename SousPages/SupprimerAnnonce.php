<?php

// Include the header

require_once("../Composants/HeaderGestion.php");

// We include the bottom of the page

require_once("../Composants/BackgroundFixed.php");

// Check if the user is logged in

require_once("../Composants/UserConnected.php");

// Include the database

require_once("../Composants/Database.php");

// We include our navigation bar

require_once("../Composants/NavbarCustom.php");

// Variable to track if an ad has been successfully removed

$annonceSupprimee = false;

// We check if the delete button has been clicked

if (isset($_POST["delete"])) {
    $idToDelete = $_POST["delete"];

    // We create the SQL query to delete a car

    $deletesql = "DELETE FROM voitures WHERE id = :id";
    $stmt = $db->prepare($deletesql);
    $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $annonceSupprimee = true;
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

?>
<h2 class="big-title">Supprimer une annonce</h2>
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
      <button type="submit" name="delete" class="btn" value="<?= $voiture["id"] ?>">Supprimer l'annonce</button>
    </form>
  </div>

  <?php endforeach; ?>

  <?php if ($annonceSupprimee): ?>

  <?php endif; ?>

</div>

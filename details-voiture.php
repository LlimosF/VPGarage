<?php

require_once("Composants/Header.php");

require_once("Composants/Database.php");

require_once("Composants/BackgroundFixed.php");

echo "<div class='page-vente'>";

if (isset($_GET['id'])) {
    $carId = $_GET['id'];

    // Select car details from database using ID

    $sql = "SELECT * FROM voitures WHERE id = :carId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
    $stmt->execute();

    // Check if the car exists

    if ($voiture = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $imageData = base64_encode($voiture['photo']);
      $imageType = 'jpeg';
      echo "<div class='card-vente details'>";
      echo '<h3 class="title-card">' . $voiture["nom"] . '</h3>';

      if (isset($voiture['photo']) && !empty($voiture['photo'])) {
        echo '<img src="data:image/' . $imageType . ';base64,' . $imageData . '" alt="Image" class="car-img">';
    }

    ?>

    <hr class='separator'>
    <p class='caracteristiques'>Caractéristiques</p>
    <hr class='separator'>
      <ul class='ul-vente'>
      <li>Nom du véhicule : <?= $voiture["nom"] ?></li>
      <li>Kilométrage : <?= $voiture["kilometrage"] ?></li>
      <li>Année : <?= $voiture["annee"] ?></li>
      <li>Transmission : <?= $voiture["transmission"] ?></li>
      <li>Cylindré : <?= $voiture["cylindre"] ?></li>
      <li>Chevaux : <?= $voiture["chevaux"] ?></li>
      <li>Prix : <?= $voiture["prix"] ?></li>
    </ul>

<?php
    } else {
        echo 'Voiture non trouvée.';
    }
} else {
    echo 'ID de voiture non spécifié.';
}
echo "</div>";
?>

<form class="form" method="POST">
  <h3 class="title-form"><?= $voiture["nom"] ?></h3>
  <div class="bloc-form">
    <label for="vehicule">Véhicule : <span>*</span></label>
  </div>
  <div class="bloc-form">
    <input type="text" id="vehicule" name="vehicule" value="<?= $voiture["nom"] ?> " readonly>
  </div>
  <div class="bloc-form">
    <label for="nom">Nom : <span>*</span></label>
  </div>
  <div class="bloc-form">
    <input type="text" id="nom" name="nom">
  </div>
  <div class="bloc-form">
    <label for="telephone">Téléphone : <span>*</span></label>
  </div>
  <div class="bloc-form">
    <input type="text" id="telephone" name="telephone">
  </div>
  <button type="submit" class="btn">Acheter</button>
</form>

<?php 

echo "</div>";

if(!empty($_POST)){
  if(isset($_POST["vehicule"], $_POST["nom"], $_POST["telephone"])
  && !empty($_POST["vehicule"]) && !empty($_POST["nom"]) && !empty($_POST["telephone"])){

    $insert = "INSERT INTO formulaire_vente(`vehicule`, `nom`, `telephone`) VALUES (:vehicule, :nom, :telephone)";
    $query = $db->prepare($insert);

    $query->bindValue(":vehicule", $_POST["vehicule"], PDO::PARAM_STR);
    $query->bindValue(":nom", $_POST["nom"], PDO::PARAM_STR);
    $query->bindValue(":telephone", $_POST["telephone"], PDO::PARAM_INT);

    $query->execute();


  }
}

// On inclu le footer

require_once("Composants/Footer.php");
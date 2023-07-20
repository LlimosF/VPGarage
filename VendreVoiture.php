<?php

// Check if the user is logged in

require_once("Composants/UserConnected.php");

// Include the database

require_once("Composants/Database.php");

// We include the header on the page

require_once("Composants/Header.php");

// We include the bottom of the page

require_once("Composants/BackgroundFixed.php");

// We include the navigation bar

require_once("Composants/NavbarCustom.php");

// We check if the method on form is equal to POST

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // We check that all the fields on the form are correctly filled in

  if (isset($_POST["nom"], $_POST["kilometrage"], $_POST["annee"], $_POST["transmission"], $_POST["cylindre"], $_POST["chevaux"], $_POST["prix"], $_FILES['photo']) 

    && !empty($_POST["nom"]) && !empty($_POST["kilometrage"]) && !empty($_POST["annee"]) && !empty($_POST["transmission"]) && !empty($_POST["cylindre"]) 
    && !empty($_POST["chevaux"]) && !empty($_POST["prix"])) {

      // We store in variables the values ​​of our inputs

      $nom = strip_tags($_POST["nom"]);
      $kilometrage = strip_tags($_POST["kilometrage"]);
      $annee = strip_tags($_POST["annee"]);
      $transmission = strip_tags($_POST["transmission"]);
      $cylindre = strip_tags($_POST["cylindre"]);
      $chevaux = strip_tags($_POST["chevaux"]);
      $prix = strip_tags($_POST["prix"]);

      // We do the verification for the photo of the car

      if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

        // We store an image in a variable

        $imageData = file_get_contents($_FILES['photo']['tmp_name']);

        // We create the SQL query to put in the table, the car

        $sql = "INSERT INTO voitures 
          (nom, kilometrage, annee, transmission, cylindre, chevaux, prix, photo) 
          VALUES 
          (:nom, :kilometrage, :annee, :transmission, :cylindre, :chevaux, :prix, :photo)"
        ;

        // We add the values ​​of the inputs to the fields of the table in the database

        $query = $db->prepare($sql);

        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':kilometrage', $kilometrage, PDO::PARAM_STR);
        $query->bindParam(':annee', $annee, PDO::PARAM_STR);
        $query->bindParam(':transmission', $transmission, PDO::PARAM_STR);
        $query->bindParam(':cylindre', $cylindre, PDO::PARAM_STR);
        $query->bindParam(':chevaux', $chevaux, PDO::PARAM_STR);
        $query->bindParam(':prix', $prix, PDO::PARAM_STR);
        $query->bindParam(':photo', $imageData, PDO::PARAM_LOB);

        // We are selling the car

        if ($query->execute()) {
          echo "Voiture ajoutée avec succès.";
        } else {
          echo "Erreur lors de l'ajout de la voiture : " . $query->errorInfo()[2];
        }
      }
    } 
    else {
      echo "Veuillez remplir tous les champs obligatoires.";
    }
  }

// We create the form for the sale of a vehicle

?>

<div>
  <h2 class="big-title">Vendre une voiture</h2>
  <form method="POST" enctype="multipart/form-data" class="form">
    <div class="bloc-form first-bloc">
      <label for="nom">Nom de la voiture :</label>
    </div>
    <div class="bloc-form">
      <input type="text" name="nom" id="nom" placeholder="Nissan 350z">
    </div>    
    <div class="bloc-form">
      <label for="kilometrage">Kilométrage :</label>
    </div>
    <div class="bloc-form">
      <input type="text" name="kilometrage" id="kilometrage" placeholder="24.679km">
    </div>
    <div class="bloc-form">
        <label for="annee">Année :</label>
    </div>
    <div class="bloc-form">
      <input type="text" name="annee" id="annee" placeholder="2009">
    </div>
    <div class="bloc-form">
      <label for="transmission">Transmission :</label>
    </div>
    <div class="bloc-form">
      <input type="text" name="transmission" id="transmission" placeholder="Manuel">
    </div>
    <div class="bloc-form">
      <label for="cylindre">Cylindré :</label>
    </div>
    <div class="bloc-form"> 
      <input type="text" name="cylindre" id="cylindre" placeholder="3L5 V8">
    </div>
    <div class="bloc-form">
      <label for="chevaux">Chevaux :</label>
    </div>
    <div class="bloc-form"> 
      <input type="text" name="chevaux" id="chevaux" placeholder="280">
    </div>
    <div class="bloc-form">
      <label for="prix">Prix :</label>
    </div>
    <div class="bloc-form">
      <input type="text" name="prix" id="prix" placeholder="26000">
    </div>
    <div class="bloc-form">
        <label for="photo">Photo :</label>
    </div>
    <div class="bloc-form">
        <input type="file" name="photo" id="photo" accept="image/jpg, image/png, image/jpeg">
    </div>
    <button type="submit" class="btn">Ajouter la voiture</button>
  </form>
</div>
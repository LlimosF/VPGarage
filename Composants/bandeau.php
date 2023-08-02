<?php

require_once("../Composants/Database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // We check that all the fields on the form are correctly filled in

  if (isset($_POST["nom"], $_FILES["image"]) 

    && !empty($_POST["nom"]) && !empty($_FILES["image"])) {

      // We store in variables the values ​​of our inputs

      $nom = strip_tags($_POST["nom"]);

      // We do the verification for the photo of the car

      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        // We store an image in a variable

        $imageData = file_get_contents($_FILES['image']['tmp_name']);

        // We create the SQL query to put in the table, the car

        $sql = "INSERT INTO bandeau_reparation(nom, image)  VALUES (:nom, :image)";

        // We add the values ​​of the inputs to the fields of the table in the database

        $query = $db->prepare($sql);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':image', $imageData, PDO::PARAM_LOB);

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
  <h2 class="big-title">Bandeau</h2>
  <form method="POST" enctype="multipart/form-data" class="form">
    <div class="bloc-form first-bloc">
      <label for="nom">Titre : <span>*</span></label>
    </div>
    <div class="bloc-form">
      <input type="text" name="nom" id="nom">
    </div>    
    <div class="bloc-form">
        <label for="image">Photo : <span>*</span></label>
    </div>
    <div class="bloc-form">
        <input type="file" name="image" id="image" accept="image/jpeg, image/png">
    </div>
    <button type="submit" class="btn">Ajouter la voiture</button>
  </form>
</div>
<?php

require_once("../Composants/Database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // On vérifie que tous les champs sur formulaire soit bien rempli

  if (isset($_POST["nom"], $_FILES["image"]) 

    && !empty($_POST["nom"]) && !empty($_FILES["image"])) {

      // On stock dans des variables les valeurs de nos inputs

      $nom = strip_tags($_POST["nom"]);

      // On fait la verification pour la photo de la voiture

      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        // On stock d'image dans une variable

        $imageData = file_get_contents($_FILES['image']['tmp_name']);

        // On créer la requête SQL pour mettre dans la table, la voiture

        $sql = "INSERT INTO bandeau_reparation(nom, image)  VALUES (:nom, :image)";

        // On ajoute les valeurs des inputs aux champs de la table en base de donnée

        $query = $db->prepare($sql);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':image', $imageData, PDO::PARAM_LOB);

        // On met en vente la voiture

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

// On créer le formulaire pour la vente d'un véhicule

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
<?php

// On inclu la base de donnée

require_once("../Composants/Database.php");

// On vérifie si le formulaire est correctement rempli

if(!empty($_POST)) {
  if(isset($_POST["nom"], $_POST["content"])
  && !empty($_POST["nom"]) && !empty($_POST["content"])) {

    // On créer la requête SQL pour ajouter le commentaire dans la base de donnée

    $sql = "INSERT INTO `commentaires_attente`(nom, content, note) VALUES (:nom, :content, :note)";

    // On rempli nos champs avec nos inputs

    $query = $db->prepare($sql);
    $query->bindValue(":nom", $_POST["nom"], PDO::PARAM_STR);
    $query->bindValue(":content", $_POST["content"], PDO::PARAM_STR);
    $query->bindValue(":note", $_POST["note"], PDO::PARAM_INT);
    $query->execute();
  }
}

// On affiche du contenu

?>

<div class="container-form">
  <div class="about-commentaire about-commentaire1">
    <p>Parce que votre avis compte, laissez nous un avis sur les préstations que vous avez récu
      de notre part.
    </p>
  </div>
  <div class="about-commentaire about-commentaire2">
    <p>
      Toute l'équipe vous remercie pour votre commentaire !
    </p>
  </div>
  <div class="form-about">
    <form method="POST" class="form">
      <h3 class="title-form">Laisser un commentaire</h3>
      <div class="bloc-form first-bloc">
        <label for="nom">Votre nom <span>*</span></label>
      </div>
      <div class="bloc-form">
        <input type="text" name="nom" id="nom" required>
      </div>
      <div class="bloc-form">
        <label for="content">Votre commentaire <span>*</span></label>
      </div>
      <div class="bloc-form">
        <input type="textarea" name="content" id="content" required>  
      </div>
      <div class="bloc-form">
        <label for="note">Note <span>*</span></label>
      </div>
      <div class="bloc-form">
        <input type="text" name="note" id="note"required>  
      </div>
      <button type="submit" class="btn">Envoyer mon commentaire</button>
    </form>
  </div>  
</div>
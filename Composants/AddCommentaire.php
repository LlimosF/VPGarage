<?php

// Include the database

require_once("Database.php");

// We check if the form is correctly filled

if(!empty($_POST)) {
  if(isset($_POST["nom"], $_POST["content"])
  && !empty($_POST["nom"]) && !empty($_POST["content"])) {

    // We create the SQL query to add the comment in the database

    $sql = "INSERT INTO `commentaires_attente`(nom, content, note) VALUES (:nom, :content, :note)";

    // We fill our fields with our inputs

    $query = $db->prepare($sql);
    $query->bindValue(":nom", $_POST["nom"], PDO::PARAM_STR);
    $query->bindValue(":content", $_POST["content"], PDO::PARAM_STR);
    $query->bindValue(":note", $_POST["note"], PDO::PARAM_INT);
    $query->execute();
  }
}

// We display content

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
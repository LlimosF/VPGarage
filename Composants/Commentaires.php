<?php

// Include the database

require_once("Database.php");

// We retrieve our comments from the database

$sql = "SELECT * FROM commentaires ORDER BY 'id' DESC";
$requete = $db->query($sql);
$commentaires = $requete->fetchAll();

// We will display all our comments on the page

?>

<div class="commentaire-container">
  <?php
  foreach($commentaires as $commentaire): ?>
  <div class="commentaire">
    <div class="top-commentaire">
      <div class="user">
        <img src="../media/homme.png" class="user-logo" alt="Photo de personnage">
      </div>
      <div>
        <p><?= $commentaire["nom"] ?></p>
      </div>
    </div>
    <div class="bottom-commentaire">
      <p><?= $commentaire["content"] ?></p>
      <p><?= $commentaire["note"] ?> / 5</p>
    </div>
  </div>
  <?php 
    endforeach; 
  ?>
</div>
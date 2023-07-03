<?php

// On inclu la base de donnée

require_once("../Composants/Database.php");

// On récupère dans la base de donnée nos commentaires

$sql = "SELECT * FROM commentaires ORDER BY 'id' DESC";
$requete = $db->query($sql);
$commentaires = $requete->fetchAll();

// On va afficher tous nos commentaires sur la page

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
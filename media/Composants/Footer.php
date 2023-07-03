<?php

// On inclu la base de donnée

require_once("../Composants/Database.php");

// On récupère dans la base de donnée tous nos horaires

$sql = "SELECT * FROM horaires ORDER BY 'id' DESC";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

// On va afficher tous nos horaires

?>

<footer class="footer">
  <div class="hourly foot-bloc">
    <h3 class="footer-title">Horaires</h3>
    <?php
      foreach($horaires as $horaire): ?>
      <li class="hourly-li"><?= $horaire["jour"]?> : <?= $horaire["matin"] ?> | <?= $horaire["apresmidi"] ?></li>
    <?php
      endforeach; 
    ?>
  </div>
  <div class="social-link foot-bloc">
    <h3 class="footer-title">Liens</h3>
    <img src="../media/instagram.png" class="logo-social">
    <img src="../media/linkedin.png" class="logo-social">
    <img src="../media/instagram.png" class="logo-social">
    <p>06 22 00 55 84</p>
  </div>
  <div class="copyright foot-bloc">
    <p>Copyright 2023 Vincent Parrot GARAGE</p>
  </div>
</footer>
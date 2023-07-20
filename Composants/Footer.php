<?php

// Include the database

require_once("Database.php");

// We retrieve all our schedules from the database

$sql = "SELECT * FROM horaires ORDER BY 'id' DESC";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

// We will post all our schedules

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
    <img src="media/instagram.png" class="logo-social">
    <img src="media/linkedin.png" class="logo-social">
    <img src="media/instagram.png" class="logo-social">
    <p>06 22 00 55 84</p>
  </div>
  <div class="copyright foot-bloc">
    <p>Copyright 2023 Vincent Parrot GARAGE</p>
  </div>
</footer>
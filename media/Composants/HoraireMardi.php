<?php

// On vérifie que l'utilisateur soit connecté

require_once("../Composants/UserConnected.php");

// On vérifie que le formulaire soit correctement rempli

if(!empty($_POST)) {
  if (isset($_POST["mardiam"], $_POST["mardipm"]) && !empty($_POST["mardiam"]) && !empty($_POST["mardipm"])) {

    // La valeur pour mardi matin

    $mardiam = $_POST["mardiam"];

    // La valeur pour mardi après-midi

    $mardipm = $_POST["mardipm"];

    // On inclu la base de donnée

    require_once("../Composants/Database.php");

    $id = 2;

    // On créer la requête SQL pour modifier les horaires du Mardi

    $sql = "UPDATE horaires SET matin = :mardiam, apresmidi = :mardipm WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':mardiam', $mardiam);
    $query->bindValue(':mardipm', $mardipm);
    $query->bindValue(':id', $id);
    $query->execute();

    if($query->execute()) {
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
    }
  }
}

// On récupère les horaires de mardi sur la base de donnée

$sql = "SELECT * FROM horaires WHERE id = 2";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- On créer le formulaire de changement d'horaires pour le Mardi -->

<form method="POST" class="form">
  <h3 class="title-form">Mardi</h3>
  <div class="bloc-form">
    <label for="mardiam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mardiam" id="mardiam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="mardipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mardipm" id="mardipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="btn">Changer pour le Mardi</button>
</form>

<?php
  endforeach; 
?>
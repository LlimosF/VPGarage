<?php

// On vérifie que l'utilisateur soit connecté

require_once("../Composants/UserConnected.php");

// On vérifie que le formulaire soit correctement rempli

if(!empty($_POST)) {
  if (isset($_POST["lundiam"], $_POST["lundipm"]) && !empty($_POST["lundiam"]) && !empty($_POST["lundipm"])) {

    // La valeur pour lundi matin

    $lundiam = $_POST["lundiam"];

    // La valeur pour lundi après-midi

    $lundipm = $_POST["lundipm"];

    // On inclu la base de donnée

    require_once("../Composants/Database.php");

    $id = 1;

    // On créer la requête SQL pour modifier les horaires du Lundi

    $sql = "UPDATE horaires SET matin = :lundiam, apresmidi = :lundipm WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':lundiam', $lundiam);
    $query->bindValue(':lundipm', $lundipm);
    $query->bindValue(':id', $id);
    $query->execute();

    if($query->execute()) {
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
    }
  }
}

// On récupère les horaires de lundi sur la base de donnée

$sql = "SELECT * FROM horaires WHERE id = 1";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- On créer le formulaire de changement d'horaires pour le Lundi -->

<form method="POST" class="form">
  <h3 class="title-form">Lundi</h3>
  <div class="bloc-form">
    <label for="lundiam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="lundiam" id="lundiam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="lundipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="lundipm" id="lundipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="btn">Changer pour le Lundi</button>
</form>

<?php
  endforeach; 
?>
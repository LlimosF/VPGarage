<?php

// On vérifie que l'utilisateur soit connecté

require_once("../Composants/UserConnected.php");

// On vérifie que le formulaire soit correctement rempli

if(!empty($_POST)) {
  if (isset($_POST["vendrediam"], $_POST["vendredipm"]) && !empty($_POST["vendrediam"]) && !empty($_POST["vendredipm"])) {

    // La valeur pour vendredi matin

    $vendrediam = $_POST["vendrediam"];

    // La valeur pour vendredi après-midi

    $vendredipm = $_POST["vendredipm"];

    // On inclu la base de donnée

    require_once("../Composants/Database.php");

    $id = 5;

    // On créer la requête SQL pour modifier les horaires du Vendredi

    $sql = "UPDATE horaires SET matin = :vendrediam, apresmidi = :vendredipm WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':vendrediam', $vendrediam);
    $query->bindValue(':vendredipm', $vendredipm);
    $query->bindValue(':id', $id);
    $query->execute();
  }
}

// On récupère les horaires de vendredi sur la base de donnée

$sql = "SELECT * FROM horaires WHERE id = 5";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- On créer le formulaire de changement d'horaires pour le Vendredi -->

<form method="POST" class="form">
  <h3 class="title-form">Vendredi</h3>
  <div class="bloc-form">
    <label for="vendrediam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="vendrediam" id="vendrediam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="vendredipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="vendredipm" id="vendredipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="btn">Changer pour le Vendredi</button>
</form>

<?php
  endforeach; 
?>
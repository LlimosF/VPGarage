<?php

// On vérifie que l'utilisateur soit connecté

require_once("../Composants/UserConnected.php");

// On vérifie que le formulaire soit correctement rempli

if(!empty($_POST)) {
  if (isset($_POST["mercrediam"], $_POST["mercredipm"]) && !empty($_POST["mercrediam"]) && !empty($_POST["mercredipm"])) {

    // La valeur pour mercredi matin

    $mercrediam = $_POST["mercrediam"];

    // La valeur pour mercredi après-midi

    $mercredipm = $_POST["mercredipm"];

    // On inclu la base de donnée

    require_once("../Composants/Database.php");

    $id = 3;

    // On créer la requête SQL pour modifier les horaires du Mercredi

    $sql = "UPDATE horaires SET matin = :mercrediam, apresmidi = :mercredipm WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':mercrediam', $mercrediam);
    $query->bindValue(':mercredipm', $mercredipm);
    $query->bindValue(':id', $id);
    $query->execute();

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
  }
}

// On récupère les horaires de mercredi sur la base de donnée

$sql = "SELECT * FROM horaires WHERE id = 3";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- On créer le formulaire de changement d'horaires pour le Mercredi -->

<form method="POST" class="form">
  <h3 class="title-form">Mercredi</h3>
  <div class="bloc-form">
    <label for="mercrediam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mercrediam" id="mercrediam" value="<?= $horaire["matin"] ?>">
  </div>  
  <div class="bloc-form">
    <label for="mercredipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mercredipm" id="mercredipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="btn">Changer pour le Mercredi</button>
</form>

<?php
  endforeach; 
?>
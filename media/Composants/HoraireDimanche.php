<?php

// On vérifie que l'utilisateur soit connecté

require_once("../Composants/UserConnected.php");

// On vérifie que le formulaire soit correctement rempli

if(!empty($_POST)) {
  if (isset($_POST["dimancheam"], $_POST["dimanchepm"]) && !empty($_POST["dimancheam"]) && !empty($_POST["dimanchepm"])) {

    // La valeur pour dimanche matin

    $dimancheam = $_POST["dimancheam"];

    // La valeur pour dimanche après-midi

    $dimanchepm = $_POST["dimanchepm"];

    // On inclu la base de donnée

    require_once("../Composants/Database.php");

    $id = 7;

    // On créer la requête SQL pour modifier les horaires du Dimanche

    $sql = "UPDATE horaires SET matin = :dimancheam, apresmidi = :dimanchepm WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':dimancheam', $dimanchepm);
    $query->bindValue(':dimancheam', $dimanchepm);
    $query->bindValue(':id', $id);
    $query->execute();

    if($query->execute()) {
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
    }
  }
}

// On récupère les horaires de dimanche sur la base de donnée

$sql = "SELECT * FROM horaires WHERE id = 7";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- On créer le formulaire de changement d'horaires pour le Dimanche -->

<form method="POST" class="form">
  <h3 class="title-form">Dimanche</h3>
  <div class="bloc-form">
    <label for="dimancheam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="dimancheam" id="dimancheam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="dimanchepm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="dimanchepm" id="dimanchepm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="btn">Changer pour le Dimanche</button>
</form>

<?php
  endforeach; 
?>
<?php

// On vérifie que l'utilisateur soit connecté

require_once("../Composants/UserConnected.php");

// On vérifie que le formulaire soit correctement rempli

if(!empty($_POST)) {
  if (isset($_POST["jeudiam"], $_POST["jeudipm"]) && !empty($_POST["jeudiam"]) && !empty($_POST["jeudipm"])) {

    // La valeur pour jeudi matin

    $jeudiam = $_POST["jeudiam"];

    // La valeur pour jeudi après-midi

    $jeudipm = $_POST["jeudipm"];

    // On inclu la base de donnée

    require_once("../Composants/Database.php");

    $id = 4;

    // On créer la requête SQL pour modifier les horaires du Jeudi

    $sql = "UPDATE horaires SET matin = :jeudiam, apresmidi = :jeudipm WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':jeudiam', $jeudiam);
    $query->bindValue(':jeudipm', $jeudipm);
    $query->bindValue(':id', $id);
    $query->execute();

    if($query->execute()) {
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
    }
  }
}

// On récupère les horaires de jeudi sur la base de donnée

$sql = "SELECT * FROM horaires WHERE id = 4";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- On créer le formulaire de changement d'horaires pour le Jeudi -->

<form method="POST" class="form">
  <h3 class="title-form">Jeudi</h3>
  <div class="bloc-form">
    <label for="jeudiam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="jeudiam" id="jeudiam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="jeudipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="jeudipm" id="jeudipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="btn">Changer pour le Jeudi</button>
</form>

<?php
  endforeach; 
?>
<?php

// On vérifie que l'utilisateur soit connecté

require_once("../Composants/UserConnected.php");

// On vérifie que le formulaire soit correctement rempli

if(!empty($_POST)) {
  if (isset($_POST["samediam"], $_POST["samedipm"]) && !empty($_POST["samediam"]) && !empty($_POST["samedipm"])) {

    // La valeur pour samedi matin

    $samediam = $_POST["samediam"];

    // La valeur pour samedi après-midi

    $samedipm = $_POST["samedipm"];

    // On inclu la base de donnée

    require_once("../Composants/Database.php");

    $id = 6;

    // On créer la requête SQL pour modifier les horaires du Samedi

    $sql = "UPDATE horaires SET matin = :samediam, apresmidi = :samedipm WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':samediam', $samedipm);
    $query->bindValue(':samediam', $samedipm);
    $query->bindValue(':id', $id);
    $query->execute();

    if($query->execute()) {
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
    }
  }
}

// On récupère les horaires de samedi sur la base de donnée

$sql = "SELECT * FROM horaires WHERE id = 6";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- On créer le formulaire de changement d'horaires pour le Jeudi -->

<form method="POST" class="form">
  <h3 class="title-form">Samedi</h3>
  <div class="bloc-form">
    <label for="samediam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="samediam" id="samediam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="samedipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="samedipm" id="samedipm" value="<?= $horaire["apresmidi"] ?>">  
  </div>
  <button type="submit" class="btn">Changer pour le Samedi</button>
</form>

<?php
  endforeach; 
?>
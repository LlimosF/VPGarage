<?php

// Check that the user is logged in

require_once("../Composants/VerifierAdmin.php");

// We check that the form is correctly filled in

if(!empty($_POST)) {
  if (isset($_POST["lundiam"], $_POST["lundipm"]) && !empty($_POST["lundiam"]) && !empty($_POST["lundipm"])) {

    // The value for Monday morning

    $lundiam = $_POST["lundiam"];

    // The value for Monday afternoon

    $lundipm = $_POST["lundipm"];

    // Include the database

    require_once("../Composants/Database.php");

    $id = 1;

    // We create the SQL query to modify Monday's schedules

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

// We retrieve Monday's schedules from the database

$sql = "SELECT * FROM horaires WHERE id = 1";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- We create the schedule change form for Monday -->

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
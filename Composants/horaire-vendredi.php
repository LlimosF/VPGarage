<?php

// Check that the user is logged in

require_once("../composants/verifier-admin.php");

// We check that the form is correctly filled in

if(!empty($_POST)) {
  if (isset($_POST["vendrediam"], $_POST["vendredipm"]) && !empty($_POST["vendrediam"]) && !empty($_POST["vendredipm"])) {

    // The value for Friday morning

    $vendrediam = $_POST["vendrediam"];

    // The value for Friday afternoon

    $vendredipm = $_POST["vendredipm"];

    // Include the database

    require_once("Database.php");

    $id = 5;

    // We create the SQL query to modify the hours of Friday

    $sql = "UPDATE horaires SET matin = :vendrediam, apresmidi = :vendredipm WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':vendrediam', $vendrediam);
    $query->bindValue(':vendredipm', $vendredipm);
    $query->bindValue(':id', $id);
    $query->execute();
  }
}

// We retrieve Friday's schedules from the database

$sql = "SELECT * FROM horaires WHERE id = 5";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- We create the schedule change form for Friday -->

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
  <button type="submit" class="validate">Changer pour le Vendredi</button>
</form>

<?php
  endforeach; 
?>
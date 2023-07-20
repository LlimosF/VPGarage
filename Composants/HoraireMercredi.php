<?php

// Check that the user is logged in

require_once("VerifierAdmin.php");

// We check that the form is correctly filled in

if(!empty($_POST)) {
  if (isset($_POST["mercrediam"], $_POST["mercredipm"]) && !empty($_POST["mercrediam"]) && !empty($_POST["mercredipm"])) {

    // The value for Wednesday morning

    $mercrediam = $_POST["mercrediam"];

    // The value for Wednesday afternoon

    $mercredipm = $_POST["mercredipm"];

    // Include the database

    require_once("Database.php");

    $id = 3;

    // We create the SQL query to modify the Wednesday schedules

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

// We retrieve Wednesday's schedules from the database

$sql = "SELECT * FROM horaires WHERE id = 3";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- We create the schedule change form for Wednesday -->

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
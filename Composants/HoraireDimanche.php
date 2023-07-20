<?php

// Check that the user is logged in

require_once("VerifierAdmin.php");

// We check that the form is correctly filled in

if(!empty($_POST)) {
  if (isset($_POST["dimancheam"], $_POST["dimanchepm"]) && !empty($_POST["dimancheam"]) && !empty($_POST["dimanchepm"])) {

    // The value for Sunday morning

    $dimancheam = $_POST["dimancheam"];

    // The value for Sunday afternoon

    $dimanchepm = $_POST["dimanchepm"];

    // Include the database

    require_once("Database.php");

    $id = 7;

    // We create the SQL query to modify the Sunday hours

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

// We retrieve the Sunday schedules from the database

$sql = "SELECT * FROM horaires WHERE id = 7";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- We create the schedule change form for Sunday -->

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
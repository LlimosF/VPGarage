<?php

// Check that the user is logged in

require_once("../composants/verifier-admin.php");

// We check that the form is correctly filled in

if(!empty($_POST)) {
  if (isset($_POST["mardiam"], $_POST["mardipm"]) && !empty($_POST["mardiam"]) && !empty($_POST["mardipm"])) {

    // The value for Tuesday morning

    $mardiam = $_POST["mardiam"];

    // The value for Tuesday afternoon

    $mardipm = $_POST["mardipm"];

    // Include the database

    require_once("Database.php");

    $id = 2;

    // We create the SQL query to modify the schedules of Tuesday

    $sql = "UPDATE horaires SET matin = :mardiam, apresmidi = :mardipm WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':mardiam', $mardiam);
    $query->bindValue(':mardipm', $mardipm);
    $query->bindValue(':id', $id);
    $query->execute();

    if($query->execute()) {
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
    }
  }
}

// We retrieve Tuesday's schedules from the database

$sql = "SELECT * FROM horaires WHERE id = 2";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- We create the schedule change form for Tuesday -->

<form method="POST" class="form">
  <h3 class="title-form">Mardi</h3>
  <div class="bloc-form">
    <label for="mardiam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mardiam" id="mardiam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="mardipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mardipm" id="mardipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="validate">Changer pour le Mardi</button>
</form>

<?php
  endforeach; 
?>
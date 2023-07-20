<?php

// Check that the user is logged in

require_once("VerifierAdmin.php");

// Check that the form is correctly filled out

if(!empty($_POST)) {
  if (isset($_POST["jeudiam"], $_POST["jeudipm"]) && !empty($_POST["jeudiam"]) && !empty($_POST["jeudipm"])) {

    // The value for Thursday morning

    $jeudiam = $_POST["jeudiam"];

    // The value for Thursday afternoon

    $jeudipm = $_POST["jeudipm"];

    // Include the database

    require_once("Database.php");

    $id = 4;

    // We create the SQL query to modify the hours of Thursday

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

// We retrieve Thursday's schedules from the database

$sql = "SELECT * FROM horaires WHERE id = 4";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- We create the schedule change form for Thursday -->

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
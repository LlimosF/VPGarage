<?php

// Check that the user is logged in

require_once("../Composants/VerifierAdmin.php");

// We check that the form is correctly filled in

if(!empty($_POST)) {
  if (isset($_POST["samediam"], $_POST["samedipm"]) && !empty($_POST["samediam"]) && !empty($_POST["samedipm"])) {

    // The value for Saturday morning

    $samediam = $_POST["samediam"];

    // The value for Saturday afternoon

    $samedipm = $_POST["samedipm"];

    // Include the database

    require_once("../Composants/Database.php");

    $id = 6;

    // We create the SQL query to modify the Saturday hours

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

// We retrieve Saturday's schedules from the database

$sql = "SELECT * FROM horaires WHERE id = 6";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<!-- We create the schedule change form for Saturday -->

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
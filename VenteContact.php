<?php

// Check that a user is logged in

require_once("Composants/UserConnected.php");

// Include the database

require_once("Composants/Database.php");

// We include the header on the page

require_once("Composants/Header.php");

// We include the bottom of the page

require_once("Composants/BackgroundFixed.php");

// We include the navigation bar

require_once("Composants/NavbarCustom.php");

?>

<h2 class="big-title">Vente contact</h2>

<?php

// We collect all our sales forms

$sql = "SELECT * FROM formulaire_vente";
$requete = $db->query($sql);
$formulaires = $requete->fetchAll();

// Delete form

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST["delete"])) {
      $id = $_POST["delete"];
      $deletesql = "DELETE FROM formulaire_vente WHERE id = :id";
      $stmt = $db->prepare($deletesql);
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);

          if($stmt->execute()) {
              header("Location: ".$_SERVER['PHP_SELF']);
              exit();
          }
      }
  }
?>

<div class="container-form">

<?php

// We display all our sales forms

foreach($formulaires as $formulaire): ?>

<form class="form" method="POST">
  <h3 class="title-form"><?= $formulaire["vehicule"] ?></h3>
  <div class="bloc-form">
    <label for="ide">Id</label>
  </div>
  <div class="bloc-form">
    <input type="text" class="center" name="ide" id="ide" value="<?= $formulaire["id"] ?>">
  </div>
  <div class="bloc-form">
    <label for="vehicule">Voiture</label>
  </div>
  <div class="bloc-form">
    <input type="text" class="center" name="vehicule" id="vehicule" value="<?= $formulaire["vehicule"] ?>">
  </div>
  <div class="bloc-form">
    <label for="nom">Nom</label>
  </div>
  <div class="bloc-form">
    <input type="text" class="center" name="nom" id="nom" value="<?= $formulaire["nom"] ?>">
  </div>
  <div class="bloc-form">
    <label for="telephone">Téléphone</label>
  </div>
  <div class="bloc-form">
    <input type="text" class="center" name="telephone" id="telephone" value="<?= $formulaire["telephone"] ?>">
  </div>
  <button type="submit" class="btn" name="delete" value="<?= $formulaire["id"] ?>">Supprimer cette demande de contact</button>
</form>
<?php
  endforeach; ?>
</div>
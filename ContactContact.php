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

<h2 class="big-title">Contact Formulaire</h2>

<?php

// We collect our contact forms

$sql = "SELECT * FROM formulaire_contact";
$requete = $db->query($sql);
$formulaires = $requete->fetchAll();

// Delete form

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST["delete"])) {
      $id = $_POST["delete"];
      $deletesql = "DELETE FROM formulaire_contact WHERE id = :id";
      $stmt = $db->prepare($deletesql);
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);

          if($stmt->execute()) {
              header("Location: ".$_SERVER['PHP_SELF']);
              exit();
          }
      }
  }
?>

<div>
  <div class="container-form">
  <?php foreach ($formulaires as $formulaire) : ?>
    <form method="POST" class="form">
      <h3 class="title-form"><?= $formulaire["nom"] . ' | ' . $formulaire["prenom"] ?></h3>
      <div class="bloc-form">
        <label for="ide">ID :</label>
      </div>
      <div class="bloc-form">
        <input type="text" name="ide" id="ide" value="<?= $formulaire["id"] ?>">
      </div>
      <div class="bloc-form">
        <label for="nom">Nom :</label>
      </div>
      <div class="bloc-form">
        <input type="text" name="nom" id="nom" value="<?= $formulaire["nom"] ?>">
      </div>
      <div class="bloc-form">
        <label for="prenom">Prénom :</label>
      </div>
      <div class="bloc-form">
        <input type="text" name="prenom" id="prenom" value="<?= $formulaire["prenom"] ?>">
      </div>
      <div class="bloc-form">
        <label for="email">E-mail :</label>
      </div>
      <div class="bloc-form">
        <input type="text" name="email" id="email" value="<?= $formulaire["email"] ?>">
      </div>
      <div class="bloc-form">
        <label for="telephone">Téléphone :</label>
      </div>
      <div class="bloc-form">
        <input type="text" name="telephone" id="telephone" value="<?= $formulaire["telephone"] ?>">
      </div>
      <div class="bloc-form">
        <label for="raison">Raison :</label>
      </div>
      <div class="bloc-form">
        <input type="text" name="raison" id="raison" value="<?= $formulaire["raison"] ?>">
      </div>
      <div class="bloc-form">
        <label for="raison">Message :</label>
      </div>
      <div class="bloc-form">
        <input type="text" name="message" id="message" value="<?= $formulaire["message"] ?>">
      </div>
      <button type="submit" class="btn" name="delete" value="<?= $formulaire["id"] ?>">Supprimer ce formulaire</button>
    </form>
    <?php 
      endforeach; 
    ?>
  </div>
</div>
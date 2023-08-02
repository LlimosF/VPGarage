<?php

// Check that a user is logged in

require_once("../composants/utilisateur-connecte.php");

// Include the database

require_once("../composants/database.php");

// We include the header on the page

require_once("../composants/header-gestion.php");

// We include the background of the page

require_once("../composants/background-fixed.php");

// We include the navigation bar

require_once("../composants/navigation-gestion.php");
?>


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
      <h3 class="title-form"><?= $formulaire["nom"] . ' ' . $formulaire["prenom"] ?></h3>
      <div class="bloc-form">
        <input type="hidden" name="ide" id="ide" value="<?= $formulaire["id"] ?>">
      </div>
      <div class="bloc-form">
        <p class="black"><?= $formulaire["nom"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black"><?= $formulaire["prenom"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black"><?= $formulaire["email"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black">0<?= $formulaire["telephone"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black"><?= $formulaire["raison"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black"><?= $formulaire["message"] ?></p>
      </div>
      <button type="submit" class="delete" name="delete" value="<?= $formulaire["id"] ?>">Supprimer ce formulaire</button>
    </form>
    <?php 
      endforeach; 
    ?>
  </div>
</div>
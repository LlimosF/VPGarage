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

// We collect all our contact forms for the workshop

$sql = "SELECT * FROM formulaire_atelier ORDER BY 'id' DESC";
$requete = $db->query($sql);
$formulaires = $requete->fetchAll();

// Delete form

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST["delete"])) {
      $id = $_POST["delete"];
      $deletesql = "DELETE FROM formulaire_atelier WHERE id = :id";
      $stmt = $db->prepare($deletesql);
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);

          if($stmt->execute()) {

              header("Location: ".$_SERVER['PHP_SELF']);
              exit();
              
          } else {
              echo "Erreur lors de la suppression de l'utilisateur";
          }
      }
  }

// We display all our contact forms for the workshop
?>

<div>
  <div class="container-form">
    <?php 
      foreach($formulaires as $formulaire):
    ?>
    <form class="form" method="POST">
      <h3 class="title-form"><?= $formulaire["prenom"] . ' ' . $formulaire["nom"] ?></h3>
      <div class="bloc-form">
        <input type="hidden" value="<?= $formulaire["id"] ?>" name="ide" id="ide" readonly/>
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
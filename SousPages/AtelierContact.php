<?php

// Check that a user is logged in

require_once("../Composants/UserConnected.php");

// Include the database

require_once("../Composants/Database.php");

// We include the header on the page

require_once("../Composants/HeaderGestion.php");

// We include the background of the page

require_once("../Composants/BackgroundFixed.php");

// We include the navigation bar

require_once("../Composants/NavbarCustom.php");

?>

<h2 class="big-title">Atelier formulaire</h2>

<?php

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
      <h3 class="title-form">Contact pour l'atelier</h3>
      <div class="bloc-form">
        <label for="ide">ID</label>
      </div>
      <div class="bloc-form">
        <input type="text" value="<?= $formulaire["id"] ?>" name="ide" id="ide" readonly/>
      </div>
      <div class="bloc-form">
        <label for="nom">Nom <span class="required">*</span></label>
      </div>
      <div class="bloc-form">
        <input type="text" name="nom" id="nom" value="<?= $formulaire["nom"] ?>" required>
      </div>
      <div class="bloc-form">
        <label for="prenom">Prénom <span class="required">*</span></label>
      </div>
      <div class="bloc-form">
        <input type="text" name="prenom" id="prenom" value="<?= $formulaire["prenom"] ?>" required>
      </div>
      <div class="bloc-form">
        <label for="email">E-mail <span class="required">*</span></label>
      </div>
      <div class="bloc-form">
        <input type="email" name="email" id="email" value="<?= $formulaire["email"] ?>" required>
      </div>
      <div class="bloc-form">
        <label for="telephone">Téléphone <span class="required">*</span></label>
      </div>
      <div class="bloc-form">
        <input type="number" name="telephone" id="telephone" value="<?= $formulaire["telephone"] ?>" required>
      </div>
      <div class="bloc-form">
        <label for="raison">Raison <span class="required">*</span></label>
      </div>
      <div class="bloc-form">
        <input type="text" name="raison" id="raison" value="<?= $formulaire["raison"] ?>">
      </div>
      <div class="bloc-form">
        <label for="message">Message <span class="required">*</span></label>
      </div>
      <div class="bloc-form">
        <input type="text" name="message" id="message" style="height: 80px;" value="<?= $formulaire["message"] ?>" required>
      </div>
      <button type="submit" class="btn" name="delete" value="<?= $formulaire["id"] ?>">Supprimer ce formulaire</button>
    </form>
    <?php 
      endforeach; 
    ?>
  </div>
</div>    
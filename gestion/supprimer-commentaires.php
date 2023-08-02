<?php

// Include header

include_once("../composants/header-gestion.php");

// Include site background

include_once("../composants/background-fixed.php");

// Check if the user is logged in

require_once("../composants/utilisateur-connecte.php");

// Include database

include_once("../composants/database.php");

// Include navigation bar

require_once("../composants/navigation-gestion.php");

// Retrieve the ID of the comment to delete

if (isset($_POST["delete"])) {
  $idToDelete = $_POST["delete"];

  // Prepare the SQL query to delete a comment

  $deletesql = "DELETE FROM commentaires WHERE id = :id";
  $stmt = $db->prepare($deletesql);
  $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);

  // Run delete query

  if ($stmt->execute()) {
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
  }
}

// Select all comments from the database

$sql = "SELECT * FROM commentaires ORDER BY id DESC";
$requete = $db->query($sql);
$commentaires = $requete->fetchAll();

// Show comments and deletion form

?>


<div>
  <div class="container-form">
    <?php foreach ($commentaires as $commentaire) : ?>
      <form method="POST" class="form">
        <h3 class="title-form"><?= $commentaire["nom"] ?></h3>
        <div class="bloc-form">
          <input type="hidden" value="<?= $commentaire["id"] ?>" name="delete" id="id" readonly />
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $commentaire["nom"] ?>" name="nom" id="nom" readonly/>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $commentaire["content"] ?>" name="content" id="content" readonly/>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $commentaire["note"] . ' / 5' ?>" name="note" id="note" readonly/>
        </div>
        <button type="submit" class="delete">Supprimer le commentaire</button>
      </form>
    <?php endforeach; ?>
  </div>
</div>

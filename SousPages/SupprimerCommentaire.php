<?php

// Include header

include_once("../Composants/HeaderGestion.php");

// Include site background

include_once("../Composants/BackgroundFixed.php");

// Check if the user is logged in

require_once("../Composants/UserConnected.php");

// Include database

include_once("../Composants/Database.php");

// Include navigation bar

require_once("../Composants/NavbarCustom.php");

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

<h2 class="big-title">Supprimer un commentaire</h2>

<div>
  <div class="container-form">
    <?php foreach ($commentaires as $commentaire) : ?>
      <form method="POST" class="form">
        <h3 class="title-form"><?= $commentaire["nom"] ?></h3>
        <div class="bloc-form">
          <label for="id">ID</label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $commentaire["id"] ?>" name="delete" id="id" readonly />
        </div>
        <div class="bloc-form">
          <label for="nom">Nom</label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $commentaire["nom"] ?>" name="nom" id="nom" />
        </div>
        <div class="bloc-form">
          <label for="content">Commentaire</label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $commentaire["content"] ?>" name="content" id="content" />
        </div>
        <div class="bloc-form">
          <label for="note">Note</label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $commentaire["note"] ?>" name="note" id="note" />
        </div>
        <button type="submit" class="btn">Supprimer le commentaire</button>
      </form>
    <?php endforeach; ?>
  </div>
</div>

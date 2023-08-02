<?php

// Include the database

require_once("../composants/database.php");

// We include the header

require_once("../composants/header-gestion.php");

// We check if a user is logged in

require_once("../composants/utilisateur-connecte.php");

// We include the management navbar

require_once("../composants/navigation-gestion.php");

// We include the background of the site

require_once("../composants/background-fixed.php");

// We retrieve the pending comments from the commentaires_attente table

$sql = "SELECT * FROM commentaires_attente ORDER BY id DESC";
$requete = $db->query($sql);
$commentaires = $requete->fetchAll();
?>

<!-- We display our pending comments -->

<div>
    <div class="container-vente">
        <?php foreach ($commentaires as $commentaire) : ?>
            <form method="POST" class="form">
                <h3 class="title-form"><?= $commentaire["nom"] . ' ' . $commentaire["note"] . ' / 5' ?></h3>
                <div class="bloc-form">
                    <input type="text" name="nom" id="nom" value="<?= $commentaire["nom"] ?>" required readonly>
                </div>
                <div class="bloc-form">
                    <input type="text" name="content" id="content" value="<?= $commentaire["content"] ?>" required readonly>
                </div>
                <div class="bloc-form">
                    <input type="text" name="note" id="note" value="<?= $commentaire["note"] ?>" required readonly>
                </div>
                <input type="hidden" name="commentaire_id" value="<?= $commentaire["id"] ?>">
                <button type="submit" class="validate" name="action" value="approve">Valider le commentaire</button>
                <button type="submit" class="delete" name="action" value="delete">Supprimer le commentaire</button>
            </form>
        <?php endforeach; ?>
    </div>
</div>

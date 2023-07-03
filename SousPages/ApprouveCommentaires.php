<?php

// Include the database

require_once("../Composants/Database.php");

// We include the header

require_once("../Composants/HeaderGestion.php");

// We check if a user is logged in

require_once("../Composants/UserConnected.php");

// We include the management navbar

require_once("../Composants/NavbarCustom.php");

// We include the background of the site

require_once("../Composants/BackgroundFixed.php");

// We check if the form is correctly filled

if (!empty($_POST)) {
    if (isset($_POST["nom"], $_POST["content"], $_POST["commentaire_id"]) && !empty($_POST["nom"]) && !empty($_POST["content"]) && !empty($_POST["commentaire_id"])) {

        // We retrieve the action of the form


        $action = $_POST["action"];

        if ($action === "delete") {

            // We delete the comment from the commentaires_attente table

            $commentaire_id = $_POST["commentaire_id"];
            $sql_delete = "DELETE FROM `commentaires_attente` WHERE id = :commentaire_id";
            $query_delete = $db->prepare($sql_delete);
            $query_delete->bindValue(":commentaire_id", $commentaire_id, PDO::PARAM_INT);
            $query_delete->execute();

            // Redirection after deletion

            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } elseif ($action === "approve") {

            // We prepare the SQL query to insert the comment in the commentaires_approuve table

            $sql_insert = "INSERT INTO `commentaires`(`nom`, `content`, `note`) VALUES (:nom, :content, :note)";
            $query_insert = $db->prepare($sql_insert);
            $query_insert->bindValue(":nom", $_POST["nom"], PDO::PARAM_STR);
            $query_insert->bindValue(":content", $_POST["content"], PDO::PARAM_STR);
            $query_insert->bindValue(":note", $_POST["note"], PDO::PARAM_INT);

            // We approve the comment

            $query_insert->execute();

            // We retrieve the identifier of the validated comment

            $commentaire_id = $_POST["commentaire_id"];

            // We delete the comment from the comment_pending table

            $sql_delete = "DELETE FROM `commentaires_attente` WHERE id = :commentaire_id";
            $query_delete = $db->prepare($sql_delete);
            $query_delete->bindValue(":commentaire_id", $commentaire_id, PDO::PARAM_INT);
            $query_delete->execute();

            // Redirection after approval

            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// ...
?>



<h2 class="big-title">Approuver les commentaires</h2>

<?php

// We retrieve the pending comments from the commentaires_attente table

$sql = "SELECT * FROM commentaires_attente ORDER BY id DESC";
$requete = $db->query($sql);
$commentaires = $requete->fetchAll();
?>

<!-- We display our pending comments -->

<div>
    <div class="container-form">
        <?php foreach ($commentaires as $commentaire) : ?>
            <form method="POST" class="form">
                <h3 class="title-form">Approuver un commentaire</h3>
                <div class="bloc-form">
                    <label for="nom">Nom <span>*</span></label>
                </div>
                <div class="bloc-form">
                    <input type="text" name="nom" id="nom" value="<?= $commentaire["nom"] ?>" required>
                </div>
                <div class="bloc-form">
                    <label for="content">Commentaire <span>*</span></label>
                </div>
                <div class="bloc-form">
                    <input type="text" name="content" id="content" value="<?= $commentaire["content"] ?>" required>
                </div>
                <div class="bloc-form">
                    <label for="note">Note <span>*</span></label>
                </div>
                <div class="bloc-form">
                    <input type="text" name="note" id="note" value="<?= $commentaire["note"] ?>" required>
                </div>
                <input type="hidden" name="commentaire_id" value="<?= $commentaire["id"] ?>">
                <button type="submit" class="btn" name="action" value="approve">Valider le commentaire</button>
                <button type="submit" class="btn" name="action" value="delete">Supprimer le commentaire</button>
            </form>
        <?php endforeach; ?>
    </div>
</div>

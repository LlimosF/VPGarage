<?php

// We include the header

require_once("Composants/Header.php");

// We include the bottom of the page

require_once("Composants/BackgroundFixed.php");

// Check that the user is logged in

require_once("Composants/UserConnected.php");

// Include the database

require_once("Composants/Database.php");

// We check that only the admin can access this page

require_once("Composants/VerifierAdmin.php");

// We include the navigation bar

require_once("Composants/NavbarCustom.php");

// We retrieve all our users in the database

$sql = "SELECT * FROM users ORDER BY id DESC";
$requete = $db->query($sql);
$users = $requete->fetchAll();

// Account deletion

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST["delete"])) {

        $id = $_POST["delete"];
        $deletesql = "DELETE FROM users WHERE id = :id";
        $stmt = $db->prepare($deletesql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                echo "Utilisateur supprimé avec succès";

                // Refresh the page after deleting the user

                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Erreur lors de la suppression de l'utilisateur";
            }
        }
    }

?>

<div>
    <h2 class="big-title">Supprimer des utilisateurs</h2>
    <div class="container-form">
        <?php foreach($users as $user): ?>
            <form method="POST" class="form">
                <h3 class="title-form"><?= $user["nom"] ?></h3>
                <div class="bloc-form">
                    <label for="ide">ID</label>
                </div>
                <div class="bloc-form">
                    <input type="text" value="<?= $user["id"] ?>" name="ide" id="ide" readonly/>
                </div>
                <div class="bloc-form">
                    <label for="nom">Nom</label>
                </div>
                <div class="bloc-form">
                    <input type="text" value="<?= $user["nom"] ?>" name="nom" id="nom" readonly/>
                </div>
                <div class="bloc-form">
                    <label for="email">E-mail</label>
                </div>
                <div class="bloc-form">
                    <input type="text" value="<?= $user["email"] ?>" name="email" id="email" readonly/>
                </div>
                <div class="bloc-form">
                    <label for="role">Rôle</label>
                </div>
                <div class="bloc-form">
                    <input type="text" value="<?= $user["role"] ?>" name="role" id="role" readonly/>
                </div>
                <button class="btn" type="submit" name="delete" value="<?= $user["id"] ?>">Supprimer l'utilisateur</button>
            </form>
        <?php 
            endforeach; 
        ?>
    </div>
</div>
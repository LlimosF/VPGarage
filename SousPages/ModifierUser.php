<?php

// Include the header

require_once("../Composants/HeaderGestion.php");

// Include the database

require_once("../Composants/Database.php");

// We include the bottom of the page

require_once("../Composants/BackgroundFixed.php");

// We include the management navigation bar

require_once("../Composants/NavbarCustom.php");

// We check that only the admin can access this page

require_once("../Composants/VerifierAdmin.php");

$sql = "SELECT * FROM users ORDER BY id DESC";
$requete = $db->query($sql);
$users = $requete->fetchAll();

// We check that the form is correctly filled in

if (!empty($_POST)) {
  if (
    isset($_POST["id"], $_POST["nom"], $_POST["email"], $_POST["role"]) &&
    !empty($_POST["id"]) && !empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["role"])
  ) {

    // We store in variables the input fields

    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $role = $_POST["role"];

    // We create an SQL query to modify our users

    $newSql = "UPDATE users SET nom = :nom, email = :email, role = :role WHERE id = :id";
    $newQuery = $db->prepare($newSql);
    $newQuery->bindValue(":nom", $nom, PDO::PARAM_STR);
    $newQuery->bindValue(":email", $email, PDO::PARAM_STR);
    $newQuery->bindValue(":role", $role, PDO::PARAM_STR);
    $newQuery->bindValue(":id", $id, PDO::PARAM_INT);

    // Modified user

    $newQuery->execute();

    if($newQuery->execute()) {
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
    }
  }
}
?>

<!-- We create the modification form for each registered user -->

<div>
  <h2 class="big-title">Modifier des utilisateurs</h2>
  <div class="container-form">
    <?php foreach ($users as $user) : ?>
      <form method="POST" class="form">
        <h3 class="title-form"><?= $user["nom"] ?></h3>
        <div class="bloc-form">
          <label for="id">ID</label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $user["id"] ?>" name="id" id="id" readonly />
        </div>
        <div class="bloc-form">
          <label for="nom">Nom</label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $user["nom"] ?>" name="nom" id="nom" />
        </div>
        <div class="bloc-form">
          <label for="email">E-mail</label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $user["email"] ?>" name="email" id="email" />
        </div>
        <div class="bloc-form">
          <label for="role">Rôle</label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $user["role"] ?>" name="role" id="role" />
        </div>
        <button type="submit" class="btn">Modifier cet utilisateur</button>
      </form>
    <?php endforeach; ?>
  </div>
</div>
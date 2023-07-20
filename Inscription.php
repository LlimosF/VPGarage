<?php

// Check that the user is logged in

require_once("Composants/UserConnected.php");

// We include the header

require_once("Composants/Header.php");

// We include the bottom of the page

require_once("Composants/BackgroundFixed.php");

// Include the database

require_once("Composants/Database.php");

// We include the navigation bar

require_once("Composants/NavbarCustom.php");

// We check if the connected account has the admin role

require_once("Composants/VerifierAdmin.php");

// Create the registration form

if(isset($_POST["nom"], $_POST["email"], $_POST["password"]) && !empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
  
  $nom = strip_tags($_POST["nom"]);
  $email = strip_tags($_POST["email"]);
  $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);
  $role = 'Employé';

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $inscription = "INSERT INTO users(`nom`, `email`, `password`, `role`) VALUES (:nom, :email, :password, :role)";

    $query = $db->prepare($inscription);
    $query->bindValue(":nom", $nom, PDO::PARAM_STR);
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->bindValue(":password", $password, PDO::PARAM_STR);
    $query->bindValue(":role", $role, PDO::PARAM_STR);
    
    $query->execute();

    if ($query->rowCount() > 0) {

      // Insert was successful

      echo "L'employé a été inscrit avec succès.";
    } else {

      // Insert failed

      echo "Une erreur s'est produite lors de l'inscription de l'employé.";
      print_r($query->errorInfo());
    }

  }
}
?>

<div>
  <h2 class="big-title">Inscrire un nouvel employé</h2>
  <form method="POST" class="form">
    <div class="bloc-title first-bloc">
      <label for="nom">Nom  <span>*</span></label>
    </div>
    <div class="bloc-form">
      <input type="text" name="nom" id="nom" required>
    </div>
    <div class="bloc-form">
      <label for="email">E-mail  <span>*</span></label>
    </div>
    <div class="bloc-form">
      <input type="email" name="email" id="email" required>
    </div>
    <div class="bloc-title">
      <label for="password">Mot de passe  <span>*</span></label>
    </div>
    <div class="bloc-form">
      <input type="password" name="password" id="password" required>
    </div>
    <button type="submit" class="btn">Inscrire</button>
  </form>
</div>

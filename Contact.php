<?php

// We include the header on the page

require_once("Composants/Header.php");

// We include the background of our site

require_once("Composants/BackgroundFixed.php");

// We check if the form and all its fields are correctly filled in

if (!empty($_POST)) {
  if (isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"], $_POST["raison"], $_POST["message"]) 
  && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["telephone"]) && !empty($_POST["raison"]) && !empty($_POST["message"])) {

    // We check the value of the fields entered by the user

    $nom = strip_tags($_POST["nom"]);
    $prenom = strip_tags($_POST["prenom"]);
    $email = strip_tags($_POST["email"]);
    $telephone = strip_tags($_POST["telephone"]);
    $raison = strip_tags($_POST["raison"]);
    $message = strip_tags($_POST["message"]);

    // We check that in the email field it is indeed an email address

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      die("L'adresse email est incorrecte !");
    }

    // Include the database

    require_once("Composants/Database.php");

    // We prepare the SQL query to add the elements entered by the user

    $sql = "INSERT INTO `formulaire_contact`(`nom`, `prenom`, `email`, `telephone`, `raison`, `message`) VALUES (:nom, :prenom, :email, :telephone, :raison, :message)";

    $query = $db->prepare($sql);

    // We associate the values ​​to their fields for our table in the database

    $query->bindValue(":nom", $nom, PDO::PARAM_STR);
    $query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->bindValue(":telephone", $telephone, PDO::PARAM_STR);
    $query->bindValue(":raison", $raison, PDO::PARAM_STR);
    $query->bindValue(":message", $message, PDO::PARAM_STR);

    // We send the contact form to the database

    $query->execute();
  }
}

// We create the contact form

?>
<div class="page">
  <form class="form" method="POST">
    <h3 class="title-form">Nous contacter</h3>
    <div class="bloc-form">
      <label for="nom">Nom <span class="required">*</span></label>
    </div>
    <div class="bloc-form">
      <input type="text" name="nom" id="nom" required>
    </div>
    <div class="bloc-form">
      <label for="prenom">Prénom <span class="required">*</span></label>
    </div>
    <div class="bloc-form">
      <input type="text" name="prenom" id="prenom" required>
    </div>
    <div class="bloc-form">
      <label for="email">E-mail <span class="required">*</span></label>
    </div>
    <div class="bloc-form">
      <input type="email" name="email" id="email" required>
    </div>
    <div class="bloc-form">
      <label for="telephone">Téléphone <span class="required">*</span></label>
    </div>
    <div class="bloc-form">
      <input type="number" name="telephone" id="telephone" required>
    </div>
    <div class="bloc-form">
      <label for="raison">Raison <span class="required">*</span></label>
    </div>
    <div class="bloc-form">
      <input type="text" name="raison" id="raison" required>
    </div>
    <div class="bloc-form">
      <label for="message">Message <span class="required">*</span></label>
    </div>
    <div class="bloc-form">
      <textarea type="text" name="message" id="message" required rows="3" style="width: 80%"></textarea>
    </div>
    <button type="submit" class="btn">Nous contacter</button>
  </form>
</div>

<?php

// We include the footer on the page

require_once("Composants/Footer.php");


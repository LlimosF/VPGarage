<?php

require_once("Database.php");

require_once("BoucleBandeau.php");

require_once("BoucleReparation.php");

require_once("Database.php");

?>

<?php

// We check that the form is correctly filled in

if (!empty($_POST)) {
  if (isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"], $_POST["raison"], $_POST["message"]) 
  && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["telephone"]) && !empty($_POST["raison"]) && !empty($_POST["message"])) {

    // We check if the email field is an email address

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      die("L'adresse email est incorrecte !");
    }

    // We prepare the SQL query to insert the form data into the table

    $sql = "INSERT INTO `formulaire_atelier`(`nom`, `prenom`, `email`, `telephone`, `raison`, `message`) VALUES (:nom, :prenom, :email, :telephone, :raison, :message)";

    // We check that the data entered by the user is not malicious

    $nom = strip_tags($_POST["nom"]);
    $prenom = strip_tags($_POST["prenom"]);
    $email = strip_tags($_POST["email"]);
    $telephone = strip_tags($_POST["telephone"]);
    $raison = strip_tags($_POST["raison"]);
    $message = strip_tags($_POST["message"]);

    $query = $db->prepare($sql);

    // We filled our table fields with the data entered by the user

    $query->bindValue(":nom", $nom, PDO::PARAM_STR);
    $query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->bindValue(":telephone", $telephone, PDO::PARAM_STR);
    $query->bindValue(":raison", $raison, PDO::PARAM_STR);
    $query->bindValue(":message", $message, PDO::PARAM_STR);

    // We send to the table

    $query->execute();
  }
}

// We display the contact form for the workshop

?>
<form class="form" method="POST">
  <h3 class="title-form">Contacter l'atelier</h3>
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
    <select name="raison" id="raison" style="width: 80%; height: 40px">
      <?php
        $sqlRaison = "SELECT * FROM reparation";
        $requetes = $db->prepare($sqlRaison);
        $requetes->execute();

        $raisons = $requetes->fetchAll();

        foreach($raisons as $raison):
      ?>
      <option value="<?= $raison["title"] ?>"><?= $raison["title"] ?></option>
      <?php
        endforeach;
      ?>
    </select>
</div>

  <div class="bloc-form">
    <label for="message">Message <span class="required">*</span></label>
  </div>
  <div class="bloc-form">
    <input type="text" name="message" id="message" style="height: 80px;" required>
  </div>
  <button type="submit" class="btn">Nous contacter</button>
</form>
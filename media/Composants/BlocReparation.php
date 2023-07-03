<?php

require_once("../Composants/Database.php");

require_once("../Composants/BoucleBandeau.php");

require_once("../Composants/BoucleReparation.php");

?>

<?php

// On vérifie que le formulaire soit correctement rempli

if (!empty($_POST)) {
  if (isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"], $_POST["raison"], $_POST["message"]) 
  && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["telephone"]) && !empty($_POST["raison"]) && !empty($_POST["message"])) {

    // On vérifie si le champs email est bien une adresse e-mail

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      die("L'adresse email est incorrecte !");
    }

    // On inclu la base de donnée

    require_once("../Composants/Database.php");

    // On prépare la requête SQL pour insérer les données du formulaire dans la table

    $sql = "INSERT INTO `formulaire_atelier`(`nom`, `prenom`, `email`, `telephone`, `raison`, `message`) VALUES (:nom, :prenom, :email, :telephone, :raison, :message)";

    // On vérifie que les données saisie par l'utilisateur ne soit pas malveillante

    $nom = strip_tags($_POST["nom"]);
    $prenom = strip_tags($_POST["prenom"]);
    $email = strip_tags($_POST["email"]);
    $telephone = strip_tags($_POST["telephone"]);
    $raison = strip_tags($_POST["raison"]);
    $message = strip_tags($_POST["message"]);

    $query = $db->prepare($sql);

    // On rempli nos champs de la table par les données saisie par l'utilisateur

    $query->bindValue(":nom", $nom, PDO::PARAM_STR);
    $query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->bindValue(":telephone", $telephone, PDO::PARAM_STR);
    $query->bindValue(":raison", $raison, PDO::PARAM_STR);
    $query->bindValue(":message", $message, PDO::PARAM_STR);

    // On envoie dans la table

    $query->execute();
  }
}

// On affiche le formulaire de contact pour l'atelier

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
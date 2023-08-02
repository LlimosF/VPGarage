<?php

// Check that the user is logged in

require_once("../composants/utilisateur-connecte.php");

// We include the header on the page

require_once("../composants/header-gestion.php");

// Include the database

require_once("../composants/database.php");

// We include the bottom of the page

require_once("../composants/background-fixed.php");

// We include the navigation bar for management

require_once("../composants/navigation-gestion.php");

// We check that all the fields of the form have been filled in correctly



// We create the SQL query to retrieve our vehicles

$sql = "SELECT * FROM voitures ORDER BY id DESC";
$requete = $db->query($sql);
$voitures = $requete->fetchAll();
?>

<!-- We create the form for modifying car ads -->

<div>
  <div class="container-vente">
    <?php foreach ($voitures as $voiture) : 
      $imageData = base64_encode($voiture["photo"]);
      $imageType = 'png';
    ?>
      <form method="POST" class="form">
        <h3 class="title-form"><?= $voiture["nom"] ?></h3>
        <div class="bloc-form">
          <?php
            echo "<img src='data:image/" . $imageType . ';base64,' . $imageData . "' alt='Image' class='card-car  ''";
          ?>  
        </div>
        <div class="bloc-form">
          <input type="hidden" value="<?= $voiture["id"] ?>" name="id" id="id" readonly />
        </div>
        <div class="bloc-form">
          <label for="nom">Nom <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $voiture["nom"] ?>" name="nom" id="nom" />
        </div>
        <div class="bloc-form">
          <label for="kilometrage">Kilométrage <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $voiture["kilometrage"] ?>" name="kilometrage" id="kilometrage" />
        </div>
        <div class="bloc-form">
          <label for="annee">Année <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $voiture["annee"] ?>" name="annee" id="annee" />
        </div>
        <div class="bloc-form">
          <label for="transmission">Transmission <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $voiture["transmission"] ?>" name="transmission" id="transmission" />
        </div>
        <div class="bloc-form">
          <label for="cylindre">Cylindrée <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $voiture["cylindre"] ?>" name="cylindre" id="cylindre" />
        </div>
        <div class="bloc-form">
          <label for="cylindre">Chevaux <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $voiture["chevaux"] ?>" name="chevaux" id="chevaux" />
        </div>
        <div class="bloc-form">
          <label for="cylindre">Prix <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $voiture["prix"] ?>" name="prix" id="prix" />
        </div>
        <button type="submit" name="modify" class="validate" value="<?= $voiture["id"] ?>">Modifier l'annonce</button>
        <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST)) {
              if (
                isset($_POST["id"], $_POST["nom"], $_POST["kilometrage"], $_POST["annee"], $_POST["transmission"], $_POST["cylindre"], $_POST["chevaux"], $_POST["prix"]) &&
                !empty($_POST["id"]) && !empty($_POST["nom"]) && !empty($_POST["kilometrage"]) && !empty($_POST["annee"]) && !empty($_POST["transmission"]) && !empty($_POST["cylindre"]) &&
                !empty($_POST["chevaux"]) && !empty($_POST["prix"])
              ) {
          
                // We store in variables the values ​​of the inputs
          
                $id = $_POST["id"];
                $nom = $_POST["nom"];
                $kilometrage = $_POST["kilometrage"];
                $annee = $_POST["annee"];
                $transmission = $_POST["transmission"];
                $cylindre = $_POST["cylindre"];
                $chevaux = $_POST["chevaux"];
                $prix = $_POST["prix"];
          
                if (!is_numeric($id)) {
                  echo "ID invalide";
                  exit();
              }
            
                // We create the SQL query to modify the cars
          
                $newSql = "UPDATE voitures SET nom = :nom, kilometrage = :kilometrage, annee = :annee, transmission = :transmission, cylindre = :cylindre, chevaux = :chevaux, prix = :prix WHERE id = :id";
            
                //Prepare the request
          
                $newQuery = $db->prepare($newSql);
            
                //We link the values ​​of the parameters to the values ​​of the variables
          
                $newQuery->bindValue(":id", $id, PDO::PARAM_INT);
                $newQuery->bindValue(":nom", $nom, PDO::PARAM_STR);
                $newQuery->bindValue(":kilometrage", $kilometrage, PDO::PARAM_INT);
                $newQuery->bindValue(":annee", $annee, PDO::PARAM_INT);
                $newQuery->bindValue(":transmission", $transmission, PDO::PARAM_STR);
                $newQuery->bindValue(":cylindre", $cylindre, PDO::PARAM_STR);
                $newQuery->bindValue(":chevaux", $chevaux, PDO::PARAM_INT);
                $newQuery->bindValue(":prix", $prix, PDO::PARAM_INT);
                $newQuery->execute();
            
                // We execute the query
          
                if ($newQuery->execute()) {
          
                  echo "<h2 class='success'>Les modifications ont été prise en compte !</h2>";
          
                } else {
          
                  echo "<h2 class='error'>Erreur lors de la modification de la voiture !</h2>";
          
                }
              }
            }  
          }
        ?>
      </form>
    </div>
    <?php endforeach; ?>
</div>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // We check that all the fields of the form are filled in correctly.

    if (isset($_POST["nom"], $_FILES["image"]) && !empty($_POST["nom"]) && !empty($_FILES["image"])) {

        // We store in variables the values ​​of our inputs

        $nom = strip_tags($_POST["nom"]);
        $id = $_POST["id"];

        // We store in variables the values ​​of our inputs

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

            // We store the image in a variable

            $imageData = file_get_contents($_FILES['image']['tmp_name']);

            // We create the SQL query to update the table

            $newSql = "UPDATE bandeau_reparation SET nom = :nom, image = :image WHERE id = :id";

            $newQuery = $db->prepare($newSql);

            $newQuery->bindValue(":id", $id, PDO::PARAM_INT);
            $newQuery->bindValue(":nom", $nom, PDO::PARAM_STR);
            $newQuery->bindValue(":image", $imageData, PDO::PARAM_LOB);
            $newQuery->execute();
        }
    }
}

$nextSql = "SELECT * FROM bandeau_reparation";
$requeteBandeau = $db->query($nextSql);
$bandeauxBoucle = $requeteBandeau->fetchAll();

?>
<div class="container-form">
    <?php
        foreach($bandeauxBoucle as $bandeaux):
    ?>
    <form method="POST" enctype="multipart/form-data" class="form">
        <?php
        $imageData = base64_encode($bandeaux["image"]);
        $imageType = 'png';
    ?>
    <h3 class="title-form"><?= $bandeaux["nom"] ?></h3>
    <div class="bloc-form">
      <?php
        echo "<img src='data:image/" . $imageType . ';base64,' . $imageData . "' alt='Image' class='img-reparation''";
      ?>
    </div>
    <div class="bloc-form">
        <label for="id">Id : <span>*</span></label>
    </div>
    <div class="bloc-form">
        <input type="text" id="id" name="id" value="<?= $bandeaux["id"] ?>" readonly>
    </div>
    <div class="bloc-form first-bloc">
        <label for="nom">Titre : <span>*</span></label>
    </div>
    <div class="bloc-form">
        <input type="text" name="nom" id="nom" value="<?= $bandeaux["nom"] ?>">
    </div>    
    <div class="bloc-form">
        <label for="image">Photo : <span>*</span></label>
    </div>
    <div class="bloc-form">
        <input type="file" name="image" id="image" accept="image/jpeg, image/png">
    </div>
    <button type="submit" class="btn">Modifier <?= $bandeaux["nom"] ?></button>
  </form>
  
    </div>
    <?php
    endforeach;
  ?>
</div>

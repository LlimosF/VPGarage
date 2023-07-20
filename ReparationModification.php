<?php

// Include the database

require_once("Composants/Database.php");

// Include the background fixed

require_once("Composants/BackgroundFixed.php");

// Include the header

require_once("Composants/Header.php");

// Include the navbar

require_once("Composants/NavbarCustom.php");

// We check that the user is indeed an admin

require_once("Composants/VerifierAdmin.php");

?>

<h2 class="big-title">Bandeau</h2>

<div>

<?php

require_once("Composants/ModifierBandeau.php");

?>

<h2 class="big-title">Réparation</h2>

<div>

  <?php

    $sql = "SELECT * FROM reparation ORDER BY 'id' DESC";
    $requete = $db->query($sql);
    $reparations = $requete->fetchAll();

    if(!empty($_POST)){
      if(isset($_POST["id"], $_POST["title"], $_POST["content"]) 
      && !empty($_POST["id"]) && !empty($_POST["title"]) && !empty($_POST["content"])){

        $id = $_POST["id"];
        $title = $_POST["title"];
        $content = $_POST["content"];

        $newSql = "UPDATE reparation SET title = :title, content = :content WHERE id = :id";

        $newQuery = $db->prepare($newSql);
        $newQuery->bindValue(":id", $id, PDO::PARAM_INT);
        $newQuery->bindValue(":title", $title, PDO::PARAM_STR);
        $newQuery->bindValue(":content", $content, PDO::PARAM_STR);

        $newQuery->execute();

      }
    }

    echo "<div class='container-form'>";

    foreach($reparations as $reparation): ?>

      <form class="form" method="POST">
        <h3 class="title-form"><?= $reparation["title"] ?></h3>
        <div class="bloc-form">
          <label for="id">Id : <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" id="id" name="id" value="<?= $reparation["id"] ?>" readonly>
        </div>
        <div class="bloc-form">
          <label for="title">Titre : <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" id="title" name="title" value="<?= $reparation["title"] ?>" >
        </div>
        <div class="bloc-form">
          <label for="content">Contenu : <span>*</span></label>
        </div>
        <div class="bloc-form">
          <input type="text" id="content" name="content" value="<?= $reparation["content"] ?>" >
        </div>
        <button type="submit" class="btn">Changer pour <?= $reparation["title"] ?></button>
      </form>

    <?php
      endforeach; 
    ?>
  </div>
</div>



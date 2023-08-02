<?php

// Check that the user is logged in

require_once("utilisateur-connecte.php");

// Include the database

require_once("database.php");

  // Comment counter

  $commentaires = "commentaires";
  $stmt = $db->query("SELECT COUNT(*) as total FROM $commentaires");
  $countCommentaires = $stmt->fetchColumn();

  // Comments pending counter

  $commentairesAttente = "commentaires_attente";
  $cmtatt = $db->query("SELECT COUNT(*) as total FROM $commentairesAttente");
  $countCommentairesAttente = $cmtatt->fetchColumn();

  // User counter

  $utilisateur = "users";
  $cntUtilisateur = $db->query("SELECT COUNT(*) as total FROM $utilisateur");
  $countUtilisateur = $cntUtilisateur->fetchColumn();

  // Contact form counter for workshop

  $formulaireAtelier = "formulaire_atelier";
  $cntFormulaireAtelier = $db->query("SELECT COUNT(*) as total FROM $formulaireAtelier");
  $countFormulaireAtelier = $cntFormulaireAtelier->fetchColumn();

  // Sales form counter

  $formulaireVente = "formulaire_vente";
  $cntFormulaireVente = $db->query("SELECT COUNT(*) as total FROM $formulaireVente");
  $countFormulaireVente = $cntFormulaireVente->fetchColumn();

  // Contact form counter

  $formulaireContact = "formulaire_contact";
  $cntFormulaireContact = $db->query("SELECT COUNT(*) as total FROM $formulaireContact");
  $countFormulaireContact = $cntFormulaireContact->fetchColumn();

  // Car counter for sale 

  $voitures = "voitures";
  $cntVoitures = $db->query("SELECT COUNT(*) as total FROM $voitures");
  $countVoitures = $cntVoitures->fetchColumn();

?>

<!-- We create the navigation bar for management -->

<div class="header1">
    <nav class="navbar1 container1">
      <h1></h1>
      <input type="checkbox" id="toggler1" />
      <label for="toggler1"><img src="../media/burger.png" class="burgerLogo1"></img></label>
      <div class="menu1">
        <ul class="list1">
        <a href="connexion.php"><li class="none">Connexion</li></a>
      <a href="creer-une-annonce.php"><li class="none">Vendre véhicule</li></a>
      <a href="supprimer-annonce.php"><li>Supprimer annonce</li></a>            
      <a href="modifier-annonce.php"><li>Véhicules en vente : | <?= $countVoitures ?> | </li></a>            
      <a href="commentaire-en-attente.php"><li>Commentaires en attente : | <?= $countCommentairesAttente ?> | </li></a>
      <a href="supprimer-commentaires.php"><li>Commentaires : | <?= $countCommentaires ?> | </li></a>
      <a href="formulaire-atelier.php"><li>Atelier formulaire : | <?= $countFormulaireAtelier ?> | </li></a>
      <a href="formulaire-vente.php"><li>Vente formulaire : | <?= $countFormulaireVente ?> | </li></a>
      <a href="formulaire-contact.php"><li>Contact : | <?= $countFormulaireContact ?> | </li></a>
      <a href="modifier-horaires.php"><li>Modifier les horaires</li></a>
      <a href="modifier-reparation.php"><li class="none">Réparation</li></a>
      <a href="inscrire-un-compte.php"><li>Inscrire un employé</li></a>
      <a href="modifier-utilisateur.php"><li>Modifier utilisateur : | <?= $countUtilisateur ?> | </li></a>
      <a href="supprimer-utilisateur.php"><li>Supprimer utilisateur</li></a>
        </ul>
      </div>
    </nav>
</div>
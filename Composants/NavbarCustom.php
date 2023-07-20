<?php

// Check that the user is logged in

require_once("UserConnected.php");

// Include the database

require_once("Database.php");

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

<div class="custom">
  <nav>
    <ul class="ul-custom">
      <a href="Connexion.php"><li class="none">Connexion</li></a>
      <a href="VendreVoiture.php"><li class="none">Vendre véhicule</li></a>
      <a href="SupprimerAnnonce.php"><li>Supprimer annonce</li></a>            
      <a href="ModifierAnnonce.php"><li>Véhicules en vente : | <?= $countVoitures ?> | </li></a>            
      <a href="Horaires.php"><li>Modifier les horaires</li></a>
      <a href="ApprouveCommentaires.php"><li>Commentaires en attente : | <?= $countCommentairesAttente ?> | </li></a>
      <a href="SupprimerCommentaire.php"><li>Commentaires : | <?= $countCommentaires ?> | </li></a>
      <a href="AtelierContact.php"><li>Atelier formulaire : | <?= $countFormulaireAtelier ?> | </li></a>
      <a href="VenteContact.php"><li>Vente formulaire : | <?= $countFormulaireVente ?> | </li></a>
      <a href="ContactContact.php"><li>Contact : | <?= $countFormulaireContact ?> | </li></a>
      <hr class="separator">
      <hr class="separator">
      <a href="ReparationModification.php"><li class="none">Réparation</li></a>
      <a href="Inscription.php"><li>Inscrire un employé</li></a>
      <a href="ModifierUser.php"><li>Modifier utilisateur : | <?= $countUtilisateur ?> | </li></a>
      <a href="SupprimerUser.php"><li>Supprimer utilisateur</li></a>
    </ul>
  </nav>
</div>
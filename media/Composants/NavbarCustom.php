<?php

// On vérifie que l'utilisateur soit bien connecté

require_once("../Composants/UserConnected.php");

// On inclu la base de donnée

require_once("../Composants/Database.php");

  // Compteur de commentaires

  $commentaires = "commentaires";
  $stmt = $db->query("SELECT COUNT(*) as total FROM $commentaires");
  $countCommentaires = $stmt->fetchColumn();

  // Compteur de commentaires en attente

  $commentairesAttente = "commentaires_attente";
  $cmtatt = $db->query("SELECT COUNT(*) as total FROM $commentairesAttente");
  $countCommentairesAttente = $cmtatt->fetchColumn();

  // Compteur d'utilisateurs

  $utilisateur = "users";
  $cntUtilisateur = $db->query("SELECT COUNT(*) as total FROM $utilisateur");
  $countUtilisateur = $cntUtilisateur->fetchColumn();

  // Compteur de formulaire de contact pour l'atelier

  $formulaireAtelier = "formulaire_atelier";
  $cntFormulaireAtelier = $db->query("SELECT COUNT(*) as total FROM $formulaireAtelier");
  $countFormulaireAtelier = $cntFormulaireAtelier->fetchColumn();

  // Compteur de formulaire de vente

  $formulaireVente = "formulaire_vente";
  $cntFormulaireVente = $db->query("SELECT COUNT(*) as total FROM $formulaireVente");
  $countFormulaireVente = $cntFormulaireVente->fetchColumn();

  // Compteur de formulaire de contact

  $formulaireContact = "formulaire_contact";
  $cntFormulaireContact = $db->query("SELECT COUNT(*) as total FROM $formulaireContact");
  $countFormulaireContact = $cntFormulaireContact->fetchColumn();

  // Compteur de voitures en vente 

  $voitures = "voitures";
  $cntVoitures = $db->query("SELECT COUNT(*) as total FROM $voitures");
  $countVoitures = $cntVoitures->fetchColumn();

?>

<!-- On créer la bar de navigation pour la gestion -->

<div class="custom">
  <nav>
    <ul class="ul-custom">
      <a href="../SousPages/Connexion.php"><li class="none">Connexion</li></a>
      <a href="../SousPages/VendreVoiture.php"><li class="none">Vendre véhicule</li></a>
      <a href="../SousPages/SupprimerAnnonce.php"><li>Supprimer annonce</li></a>            
      <a href="../SousPages/ModifierAnnonce.php"><li>Véhicules en vente : | <?= $countVoitures ?> | </li></a>            
      <a href="../SousPages/Horaires.php"><li>Modifier les horaires</li></a>
      <a href="../SousPages/ApprouveCommentaires.php"><li>Commentaires en attente : | <?= $countCommentairesAttente ?> | </li></a>
      <a href="../SousPages/SupprimerCommentaire.php"><li>Commentaires : | <?= $countCommentaires ?> | </li></a>
      <a href="../SousPages/AtelierContact.php"><li>Atelier formulaire : | <?= $countFormulaireAtelier ?> | </li></a>
      <a href="../SousPages/VenteContact.php"><li>Vente formulaire : | <?= $countFormulaireVente ?> | </li></a>
      <a href="../SousPages/ContactContact.php"><li>Contact : | <?= $countFormulaireContact ?> | </li></a>
      <hr class="separator">
      <hr class="separator">
      <a href="../SousPages/ReparationModification.php"><li class="none">Réparation</li></a>
      <a href="../SousPages/Inscription.php"><li>Inscrire un employé</li></a>
      <a href="../SousPages/ModifierUser.php"><li>Modifier utilisateur : | <?= $countUtilisateur ?> | </li></a>
      <a href="../SousPages/SupprimerUser.php"><li>Supprimer utilisateur</li></a>
    </ul>
  </nav>
</div>
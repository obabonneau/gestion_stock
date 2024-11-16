<?php

/////////////////////////////////////////
// MISE A JOUR D'UN FOURNISSEUR EN BDD //
/////////////////////////////////////////

// RECUPERATION, VALIDATION DU FOURNISSEUR SELECTIONNE si lien conforme dans formulaire_fournisseur.php
$idfournisseur = isset($_GET['idfournisseur']) ? $_GET['idfournisseur'] : null;
if ($idfournisseur) {

    // RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme
    $societe = $_POST['societe'] ?? null;
    $adresse = $_POST['adresse'] ?? null;
    $cp = $_POST['cp'] ?? null;
    $ville = $_POST['ville'] ?? null;
    $commentaire = $_POST['commentaire'] ?? null;

    if (!$societe || !$adresse || !$cp || !$ville || !$commentaire) {
        echo "<h1>Paramètres non spécifiés ou manquants !</h1>";
    } else {

        // MISE A JOUR DU FOURNISSEUR EN BASE DE DONNEES
        try {
            $requete = $connexion->prepare("UPDATE fournisseurs SET
                societe = :societe,
                adresse = :adresse,
                cp = :cp,
                ville = :ville,
                commentaire = :commentaire 
                WHERE idfournisseur = :idfournisseur");            
            $requete->bindParam(':societe', $societe);
            $requete->bindParam(':adresse', $adresse);
            $requete->bindParam(':cp', $cp);
            $requete->bindParam(':ville', $ville);
            $requete->bindParam(':commentaire', $commentaire);
            $requete->bindParam(':idfournisseur', $idfournisseur);
            $requete->execute();

            echo "<h1>Fournisseur mis à jour avec succès !</h1>";
        } catch (PDOException $e) {
            //echo 'Erreur:'. $e->getMessage();
            echo "<h1>Fournisseur non spécifié ou manquant !</h1>";
        }
    }
} else {
    
}
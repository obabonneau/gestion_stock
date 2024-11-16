<?php

/////////////////////////////////////
// MISE A JOUR D'UN PRODUIT EN BDD //
/////////////////////////////////////

// RECUPERATION, VALIDATION DU PRODUIT SELECTIONNE si lien conforme dans formulaire_produit.php
$idproduit = isset($_GET['idproduit']) ? $_GET['idproduit'] : null;
if ($idproduit) {
    
    // RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme
    $idfournisseur = $_POST['idfournisseur'] ?? null;
    $reference = $_POST['reference'] ?? null;
    $nom = $_POST['nom'] ?? null;
    $quantite = $_POST['quantite'] ?? null;
    $commentaire = $_POST['commentaire'] ?? null;

    if (!$idfournisseur || !$reference || !$nom || !$quantite || !$commentaire) {
        echo "<h1>Paramètres non spécifiés ou manquants !</h1>";
    } else {

        // MISE A JOUR DU PRODUIT EN BASE DE DONNEES
        try {
            $requete = $connexion->prepare("UPDATE produits SET
                idfournisseur = :idfournisseur,
                reference = :reference,
                nom = :nom,
                quantite = :quantite,
                commentaire = :commentaire 
                WHERE idproduit = :idproduit");
            $requete->bindParam(':idfournisseur', $idfournisseur);
            $requete->bindParam(':reference', $reference);
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':quantite', $quantite);
            $requete->bindParam(':commentaire', $commentaire);
            $requete->bindParam(':idproduit', $idproduit);
            $requete->execute();

            echo "<h1>Produit mis à jour avec succès !</h1>";
        } catch (PDOException $e) {
            echo 'Erreur:'. $e->getMessage();
            echo "<h1>Produit non spécifié ou manquant !</h1>";
        }
    }
} else {
    echo "<h1>ID Produit non spécifié ou manquant !</h1>";
}
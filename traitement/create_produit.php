<?php

//////////////////////////////////
// CREATION D'UN PRODUIT EN BDD //
//////////////////////////////////

// RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme
$idfournisseur = $_POST['idfournisseur'] ?? null;
$reference = $_POST['reference'] ?? null;
$nom = $_POST['nom'] ?? null;
$quantite = $_POST['quantite'] ?? null;
$commentaire = $_POST['commentaire'] ?? null;

if ($idfournisseur && $reference && $nom && $quantite && $commentaire) {
    
    // CREATION DU PRODUIT EN BASE DE DONNEES
    try {
        $requete = $connexion->prepare("INSERT INTO produits (idfournisseur, reference, nom, quantite, commentaire)
            VALUES (:idfournisseur, :reference, :nom, :quantite, :commentaire)");
        $requete->bindParam(':idfournisseur', $idfournisseur);
        $requete->bindParam(':reference', $reference);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':quantite', $quantite);
        $requete->bindParam(':commentaire', $commentaire);
        $requete->execute();

        echo "<h1>Produit crée avec succès !</h1>";
    } catch (PDOException $e) {
        //echo 'Erreur:'. $e->getMessage();
        echo "<h1>Erreur lors de la création du produit !</h1>";
    }
} else {
    echo "<h1>Paramètres non spécifiés ou manquants !</h1>";
}
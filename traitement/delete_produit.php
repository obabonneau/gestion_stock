<?php

/////////////////////////////////////
// SUPPRESSION D'UN PRODUIT EN BDD //
/////////////////////////////////////

// RECUPERATION, VALIDATION DU PRODUIT SELECTIONNE si lien conforme dans liste_produit.php
$idproduit = isset($_GET['idproduit']) ? $_GET['idproduit'] : null;
if ($idproduit) {
   
    // SUPPRESSION DU PRODUIT EN BASE DE DONNEES
    try {
        $requete = $connexion->prepare("DELETE FROM produits WHERE idproduit=:idproduit");
        $requete->bindParam(':idproduit', $idproduit);
        $requete->execute();

        echo "<h1>Produit supprimé avec succès !</h1>";
    } catch (PDOException $e) {
        //echo 'Erreur:' . $e->getMessage();
        echo "<h1>Erreur lors de la suppression du produit !</h1>";
    }
} else {
    echo "<h1>Produit non spécifié ou manquant !</h1>";
}
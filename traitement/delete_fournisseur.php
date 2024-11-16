<?php

/////////////////////////////////////////
// SUPPRESSION D'UN FOURNISSEUR EN BDD //
/////////////////////////////////////////

// RECUPERATION, VALIDATION DU FOURNISSEUR SELECTIONNE si lien conforme dans liste_fournisseur.php
$idfournisseur = isset($_GET['idfournisseur']) ? $_GET['idfournisseur'] : null;
if ($idfournisseur) {
    
    // SUPPRESSION DU FOURNISSEUR EN BASE DE DONNEES
    try {
        $requete = $connexion->prepare("DELETE FROM fournisseurs WHERE idfournisseur=:idfournisseur");
        $requete->bindParam(':idfournisseur', $idfournisseur);
        $requete->execute();

        echo "<h1>Fournisseur supprimé avec succès !</h1>";
    } catch (PDOException $e) {
        //echo 'Erreur:' . $e->getMessage();
        echo "<h1>Erreur lors de la suppression du fournisseur !</h1>";
    }
} else {
    echo "<h1>Produit non spécifié ou manquant !</h1>";
}
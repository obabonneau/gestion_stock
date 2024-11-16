<?php

//////////////////////////////////////
// CREATION D'UN FOURNISSEUR EN BDD //
//////////////////////////////////////

// RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme
$societe = $_POST['societe'] ?? null;
$adresse = $_POST['adresse'] ?? null;
$cp = $_POST['cp'] ?? null;
$ville = $_POST['ville'] ?? null;
$commentaire = $_POST['commentaire'] ?? null;

if ($societe && $adresse && $cp && $ville && $commentaire) {

    // CREATION DU FOURNISSEUR EN BASE DE DONNEES
    try {
        $requete = $connexion->prepare("INSERT INTO fournisseurs (societe, adresse, cp, ville, commentaire)
            VALUES (:societe, :adresse, :cp, :ville, :commentaire)");
        $requete->bindParam(':societe', $societe);
        $requete->bindParam(':adresse', $adresse);
        $requete->bindParam(':cp', $cp);
        $requete->bindParam(':ville', $ville);
        $requete->bindParam(':commentaire', $commentaire);
        $requete->execute();

        echo "<h1>Fournisseur crée avec succès !</h1>";
    } catch (PDOException $e) {
        //echo 'Erreur:'. $e->getMessage();
        echo "<h1>Erreur lors de la création du fournisseur !</h1>";
    }
} else {
    echo "<h1>Paramètres non spécifiés ou manquants !</h1>";
}
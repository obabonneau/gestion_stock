<?php

// INTEGRATION DES PAGES connect, header et menu
include "traitement/connect.php";
include "corps/header.php";
include "corps/menu.php";

// RECUPERATION DE LA PAGE
$page = $_GET["page"] ?? "listeProduit";

// SWITCH DE PAGES
switch ($page) {

        // PAGES LIEES AUX PRODUITS
    case "listeProduit":
        include "pages/liste_produit.php";
        break;

    case "formulaireProduit":
        include "pages/formulaire_produit.php";
        break;

    case "createProduit":
        include "traitement/create_produit.php";
        break;

    case "updateProduit":
        include "traitement/update_produit.php";
        break;

    case "deleteProduit":
        include "traitement/delete_produit.php";
        break;

        // PAGES LIEES AUX FOURNISSEURS
    case "listeFournisseur":
        include "pages/liste_fournisseur.php";
        break;

    case "formulaireFournisseur":
        include "pages/formulaire_fournisseur.php";
        break;

    case "createFournisseur":
        include "traitement/create_fournisseur.php";
        break;

    case "updateFournisseur":
        include "traitement/update_fournisseur.php";
        break;

    case "deleteFournisseur":
        include "traitement/delete_fournisseur.php";
        break;

    default:
        include "pages/liste_produit.php";
        break;
}

// INTEGRATION DE LA PAGE footer
include "corps/footer.php";
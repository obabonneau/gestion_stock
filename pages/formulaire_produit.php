<?php

// DESACTIVATION DU FORMULAIRE
$formulaire = false;

///////////////////////////
// CREATION D'UN PRODUIT //
///////////////////////////

// LECTURE DES FOURNISSEURS (Pour menu déroulant)
$requete = $connexion->prepare("SELECT * FROM fournisseurs");
$requete->execute();
$fournisseurs = $requete->fetchall(PDO::FETCH_ASSOC);

// RECUPERATION, VALIDATION DU PARAMETRE "CREATE" si lien conforme dans menu.php
$param = isset($_GET['param']) ? $_GET['param'] : null;
if ($param == "create") {
    $formulaire = true; // On active le formulaire.

    // DEFINITION D'UN CONTENU VIERGE
    $titre = "Ajouter un produit";
    $action = "index.php?page=createProduit";

    $idfournisseur = null;
    $reference = null;
    $nom = null;
    $quantite = null;
    $commentaire = null;
} else {

    //////////////////////////////
    // MISE A JOUR D'UN PRODUIT //
    //////////////////////////////

    // RECUPERATION, VALIDATION DU PRODUIT A METTRE A JOUR si lien conforme dans liste_fournisseur.php
    $idproduit = isset($_GET['idproduit']) ? $_GET['idproduit'] : null;
    if ($idproduit) {

        // LECTURE, VALIDATION DU FOURNISSEUR EN BASE DE DONNEES si existant
        $requete = $connexion->prepare("SELECT * FROM produits WHERE idproduit = :idproduit");
        $requete->bindParam(':idproduit', $idproduit);
        $requete->execute();
        $produit = $requete->fetch(PDO::FETCH_ASSOC);

        // RECUPERATION DU CONTENU DU PRODUIT A METTRE A JOUR
        if ($produit) {
            $formulaire = true; // On active le formulaire.

            $titre = "Modifier un produit";
            $action = "index.php?page=updateProduit&idproduit=$idproduit";

            // RECUPERATION DU CONTENU DU PRODUIT
            $idfournisseur = $produit['idfournisseur'];
            $reference = $produit['reference'];
            $nom = $produit['nom'];
            $quantite = $produit['quantite'];
            $commentaire = $produit['commentaire'];
        } else {
            echo "<h1>Produit non trouvé !</h1>";
        }
    } else {
        echo "<h1>ID Produit non spécifié ou manquant !</h1>";
    }
}

/////////////////////////////
// AFFICHAGE DU FORMULAIRE //
/////////////////////////////

if ($formulaire) {
?>

    <!-- TITRE DE LA PAGE -->
    <h1><?php echo $titre ?></h1>

    <!-- FORMULAIRE -->
    <form method="post" action="<?php echo $action ?>">

        <fieldset>

            <!-- CHAMPS A GAUCHE -->
            <div class="champGauche">

                <!-- CHAMP FOURNISSEUR -->
                <label for="idfournisseur">Fournisseur</label>
                <select id="idfournisseur" name="idfournisseur">
                    <?php

                    // ALIMENTATION DU MENU DEROULANT AVEC LA LISTE DES FOURNISSEURS        
                    foreach ($fournisseurs as $fournisseur) {
                        if ($idfournisseur == $fournisseur['idfournisseur']) {
                            echo "<option value=" . $fournisseur['idfournisseur'] . " selected>" . $fournisseur['societe'] . "</option>";
                        } else {
                            echo "<option value=" . $fournisseur['idfournisseur'] . ">" . $fournisseur['societe'] . "</option>";
                        }
                    }
                    ?>
                </select><br>

                <!-- CHAMP COMMENTAIRE -->
                <label for="commentaire">Commentaire</label>
                <textarea id="commentaire" name="commentaire" rows="5"><?php echo $commentaire; ?></textarea>
            </div>

            <!-- CHAMPS A DROITE -->
            <div class="champDroit">

                <!-- CHAMP REFERENCE -->
                <label for="reference">Reférence</label>
                <input type="text" id="reference" name="reference" value="<?php echo $reference; ?>"><br>

                <!-- CHAMP NOM -->
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>"><br>

                <!-- CHAMP QUANTITE -->
                <label for="quantite">Quantité</label>
                <input type="number" id="quantite" name="quantite" value="<?php echo $quantite; ?>">
            </div>

        </fieldset>

        <!-- BOUTON D'ENVOI -->
        <input type="submit" value="Valider">

    </form>

<?php
}
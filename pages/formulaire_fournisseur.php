<?php

// DESACTIVATION DU FORMULAIRE
$formulaire = false; 

///////////////////////////////
// CREATION D'UN FOURNISSEUR //
///////////////////////////////

// RECUPERATION, VALIDATION DU PARAMETRE "CREATE" si lien conforme dans menu.php
$param = isset($_GET['param']) ? $_GET['param'] : null;
if ($param == "create") {
    $formulaire = true; // On active le formulaire.

    // DEFINITION D'UN CONTENU VIERGE
    $titre = "Ajouter un fournisseur";
    $action = "index.php?page=createFournisseur";

    $societe = null;
    $adresse = null;
    $cp = null;
    $ville = null;
    $commentaire = null;
} else {

    //////////////////////////////////
    // MISE A JOUR D'UN FOURNISSEUR //
    //////////////////////////////////

    // RECUPERATION, VALIDATION DU FOURNISSEUR A METTRE A JOUR si lien conforme dans liste_fournisseur.php
    $idfournisseur = isset($_GET['idfournisseur']) ? $_GET['idfournisseur'] : null;
    if ($idfournisseur) {

        // LECTURE, VALIDATION DU FOURNISSEUR EN BASE DE DONNEES si existant       
        $requete = $connexion->prepare("SELECT * FROM fournisseurs WHERE idfournisseur = :idfournisseur");
        $requete->bindParam(':idfournisseur', $idfournisseur);
        $requete->execute();
        $fournisseur = $requete->fetch(PDO::FETCH_ASSOC);

        if ($fournisseur) {
            $formulaire = true; // On active le formulaire.

            // RECUPERATION DU CONTENU DU FOURNISSEUR
            $titre = "Modifier un fournisseur";
            $action = "index.php?page=updateFournisseur&idfournisseur=$idfournisseur";

            $societe = $fournisseur['societe'];
            $adresse = $fournisseur['adresse'];
            $cp = $fournisseur['cp'];
            $ville = $fournisseur['ville'];
            $commentaire = $fournisseur['commentaire'];
        } else {
            echo "<h1>Fournisseur non trouvé !</h1>";
        }
    } else {
        echo "<h1>ID Fournisseur non spécifié ou manquant !</h1>";
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

                <!-- CHAMP SOCIETE -->
                <label for="societe">Société</label>
                <input type="text" id="societe" name="societe" value="<?php echo $societe ?>"><br>

                <!-- CHAMP COMMENTAIRE -->
                <label for="commentaire">Commentaire</label>
                <textarea id="commentaire" name="commentaire" rows="5"><?php echo $commentaire; ?></textarea>
            </div>

            <!-- CHAMPS A DROITE -->
            <div class="champDroit">

                <!-- CHAMP ADRESSE -->
                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo $adresse; ?>"><br>

                <!-- CHAMP CP -->
                <label for="cp">Code postal</label>
                <input type="text" id="cp" name="cp" value="<?php echo $cp; ?>"><br>

                <!-- CHAMP VILLE -->
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" value="<?php echo $ville; ?>">
            </div>
        </fieldset>

        <!-- BOUTON D'ENVOI -->
        <input type="submit" value="Valider">
    </form>
<?php
}
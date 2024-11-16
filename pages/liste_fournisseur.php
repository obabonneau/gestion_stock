<?php

////////////////////////////////
// RECHERCHE D'UN FOURNISSEUR //
////////////////////////////////

// RECUPERATION, VALIDATION DU PARAMETRE "SEARCH" si lien conforme
$search = $_POST['search'] ?? null;
if ($search) {

    $search = "%" . $search . "%"; // Nécessaire pour lancer la recherche en bdd

    // LECTURE DU FOURNISSEUR SELECTIONNE EN BASE DE DONNEES si existant    
    $requete = $connexion->prepare("SELECT idfournisseur, societe, adresse, cp, ville, commentaire
        FROM fournisseurs
        WHERE idfournisseur LIKE :search
        OR societe LIKE :search
        OR adresse LIKE :search
        OR cp LIKE :search
        OR ville LIKE :search
        OR commentaire LIKE :search
        ORDER BY societe ASC");
    $requete->bindParam(':search', $search);
    $requete->execute();
    $fournisseurs = $requete->fetchall(PDO::FETCH_ASSOC);

    if (!$fournisseurs) {
        $fournisseurs[] = [
            'societe' => "Inconnu",
            'adresse' => "...",
            'cp' => "...",
            'ville' => "...",
            'commentaire' => "...",
            'idfournisseur' => null
        ];
    }
} else {

    //////////////////////////////
    // LECTURE DES FOURNISSEURS //
    //////////////////////////////

    // LECTURE DES FOURNISSEURS EN BASE DE DONNEES
    $requete = $connexion->prepare("SELECT * FROM fournisseurs ORDER BY societe ASC");
    $requete->execute();
    $fournisseurs = $requete->fetchall(PDO::FETCH_ASSOC);
}
?>

<!----------------------------->
<!-- FORMULAIRE DE RECHERCHE -->
<!----------------------------->

<form class="recherche" method="post" action="#">

    <!-- CHAMP DE RECHERCHE -->
    <label for="search">Rechercher un fournisseur</label>
    <input type="text" id="search" name="search" placeholder="Rechercher...">

    <!-- BOUTON D'ENVOI -->
    <input type="submit" value="Lancer la recherche">
</form>

<!------------------------------>
<!-- TABLEAU DES FOURNISSEURS -->
<!------------------------------>

<table>
    <caption>Liste des fournisseurs</caption>

    <!-- ENTETE DU TABLEAU -->
    <tr>
        <th>Société</th>
        <th>Adresse</th>
        <th>Code Postal</th>
        <th>Ville</th>
        <th>Commentaire</th>
        <th></th>
    </tr>

    <?php

    // ALIMENTATION DU TABLEAU DES FOURNISSEURS
    foreach ($fournisseurs as $fournisseur) {
    ?>
        <tr>
            <td><?php echo $fournisseur['societe']; ?></td>
            <td><?php echo $fournisseur['adresse']; ?></td>
            <td><?php echo $fournisseur['cp']; ?></td>
            <td><?php echo $fournisseur['ville']; ?></td>
            <td><?php echo $fournisseur['commentaire']; ?></td>
            <td class="derniereColonne">
                <a href="index.php?page=formulaireFournisseur&idfournisseur=<?php echo $fournisseur['idfournisseur']; ?>"><i class='fa-solid fa-pen-to-square'></i></a> /
                <a href="index.php?page=deleteFournisseur&idfournisseur=<?php echo $fournisseur['idfournisseur']; ?>"><i class='fa-solid fa-trash'></i></a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
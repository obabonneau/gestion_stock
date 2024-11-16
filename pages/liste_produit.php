<?php

////////////////////////////
// RECHERCHE D'UN PRODUIT //
////////////////////////////

// RECUPERATION, VALIDATION DU PARAMETRE "SEARCH" si lien conforme
$search = $_POST['search'] ?? null;
if ($search) {

    $search = "%" . $search . "%"; // Nécessaire pour lancer la recherche en bdd

    // LECTURE DU PRODUIT SELECTIONNE EN BASE DE DONNEES si existant
    $requete = $connexion->prepare("SELECT produits.idproduit, fournisseurs.societe, produits.reference, produits.nom, produits.quantite, produits.commentaire
        FROM produits INNER JOIN fournisseurs ON produits.idfournisseur=fournisseurs.idfournisseur
        WHERE fournisseurs.societe LIKE :search
        OR produits.nom LIKE :search
        OR produits.reference LIKE :search
        OR produits.reference LIKE :search
        OR produits.commentaire LIKE :search
        OR produits.commentaire LIKE :search
        ORDER BY produits.nom ASC");
    $requete->bindParam(':search', $search);
    $requete->execute();
    $produits = $requete->fetchall(PDO::FETCH_ASSOC);

    if (!$produits) {
        $produits[] = [
            'societe' => "Inconnu",
            'reference' => "...",
            'nom' => "...",
            'quantite' => "...",
            'commentaire' => "...",
            'idproduit' => null
        ];
    }
} else {

    /////////////////////////////
    // LECTURE DES DE PRODUITS //
    /////////////////////////////

    // LECTURE DES PRODUITS EN BASE DE DONNEES
    $requete = $connexion->prepare("SELECT produits.idproduit, fournisseurs.societe, produits.reference, produits.nom, produits.quantite, produits.commentaire
        FROM produits INNER JOIN fournisseurs ON produits.idfournisseur=fournisseurs.idfournisseur ORDER BY produits.nom ASC");
    $requete->execute();
    $produits = $requete->fetchall(PDO::FETCH_ASSOC);
}
?>

<!----------------------------->
<!-- FORMULAIRE DE RECHERCHE -->
<!----------------------------->

<form class="recherche" method="post" action="#">

    <!-- CHAMP DE RECHERCHE -->
    <label for="search">Rechercher un produit</label>
    <input type="text" id="search" name="search" placeholder="Rechercher...">

    <!-- BOUTON D'ENVOI -->
    <input type="submit" value="Lancer la recherche">
</form>


<!------------------------------>
<!-- TABLEAU DES FOURNISSEURS -->
<!------------------------------>

<table>
    <caption>Liste des produits</caption>

    <!-- ENTETE DU TABLEAU -->
    <tr>
        <th>Fournisseur</th>
        <th>Référence</th>
        <th>Nom</th>
        <th>Quantité</th>
        <th>Commentaire</th>
        <th></th>
    </tr>

    <?php

    // ALIMENTATION DU TABLEAU DES PRODUITS
    foreach ($produits as $produit) {
    ?>
        <tr>
            <td><?php echo $produit['societe']; ?></td>
            <td><?php echo $produit['reference']; ?></td>
            <td><?php echo $produit['nom']; ?></td>
            <td><?php echo $produit['quantite']; ?></td>
            <td><?php echo $produit['commentaire']; ?></td>
            <td class="derniereColonne">
                <a href="index.php?page=formulaireProduit&idproduit=<?php echo $produit['idproduit']; ?>"><i class='fa-solid fa-pen-to-square'></i></a> /
                <a href="index.php?page=deleteProduit&idproduit=<?php echo $produit['idproduit']; ?>"><i class='fa-solid fa-trash'></i></a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<?php

///////////////////////////
// RECHERCHE D'UN LIVRE //
//////////////////////////

// RECUPERATION, VALIDATION DU PARAMETRE "search" si lien conforme dans liste_livre.php
$search = $_POST['search'] ?? null;

if ($search) {
    $search = "%" . $search . "%"; // Nécessaire pour lancer la recherche en bdd

    // INSTANCIATION D'UN OBJET "searchLivre"
    $searchLivre = new Livres();

    // UTILISATION DE LA METHODE "search" DE L'OBJET
    $livres = $searchLivre->searchLivre($search);

    if (!$livres) {
        $livres[0] = new Livres();
        $livres[0]->setIDlivre("0");
        $livres[0]->setTitre("...");
        $livres[0]->setAuteur("...");
        $livres[0]->setGenre("...");
        $livres[0]->setAnnee("...");
        $livres[0]->setEtat("...");
    }
} else {

    ////////////////////////
    // LECTURE DES LIVRES //
    ////////////////////////

    // INSTANCIATION D'UN OBJET "readLivres"
    $readLivres = new Livres();

    // UTILISATION DE LA METHODE "read" DE L'OBJET
    $livres = $readLivres->readLivres();
}
?>

<!----------------------------->
<!-- FORMULAIRE DE RECHERCHE -->
<!----------------------------->
<form class="recherche" method="post" action="#">

    <!-- CHAMP DE RECHERCHE -->
    <label for="search">Rechercher un livre</label>
    <input type="text" id="search" name="search" placeholder="Rechercher...">

    <!-- BOUTON D'ENVOI -->
    <input type="submit" value="Lancer la recherche">
</form>

<!------------------------>
<!-- TABLEAU DES LIVRES -->
<!------------------------>
<table>
    <caption>Liste des livres</caption>

    <!-- ENTETE DU TABLEAU -->
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Genre</th>
        <th>Année</th>
        <th>Etat</th>
        <th></th>
    </tr>

    <?php

    // ALIMENTATION DU TABLEAU DES LIVRES
    foreach ($livres as $livre) {
    ?>
        <tr>
            <td><?php echo $livre->getTitre(); ?></td>
            <td><?php echo $livre->getAuteur(); ?></td>
            <td><?php echo $livre->getGenre(); ?></td>
            <td><?php echo $livre->getAnnee(); ?></td>
            <td><?php
                if ($livre->getEtat()) {
                    echo "Libre";
                } else {
                    echo "Réservé";
                }
                ?>
            </td>
            <td class="derniereColonne">
                <a href="index.php?page=formulaire_livre&id_livre=<?php echo $livre->getIDlivre(); ?>"><i class='fa-solid fa-pen-to-square'></i></a> /
                <a href="index.php?page=delete_livre&id_livre=<?php echo $livre->getIDlivre(); ?>"><i class='fa-solid fa-trash'></i></a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
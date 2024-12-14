<?php

////////////////////////////
// RECHERCHE D'UN EMPRUNT //
////////////////////////////

// RECUPERATION, VALIDATION DU PARAMETRE "search" si lien conforme dans liste_emprunt.php
$search = $_POST['search'] ?? null;

if ($search) {
    $search = "%" . $search . "%"; // Nécessaire pour lancer la recherche en bdd

    // INSTANCIATION D'UN OBJET "searchLivre"
    $searchEmprunt = new Emprunts();

    // UTILISATION DE LA METHODE "search" DE L'OBJET
    $emprunts = $searchEmprunt->searchEmprunt($search);

    if (!$emprunts) {
        $emprunts[0] = new Emprunts();
    }
} else {

    //////////////////////////
    // LECTURE DES EMPRUNTS //
    //////////////////////////

    // INSTANCIATION D'UN OBJET "readLivres"
    $readEmprunts = new Emprunts();

    // UTILISATION DE LA METHODE "read" DE L'OBJET
    $emprunts = $readEmprunts->readEmprunts();
}
?>

<!----------------------------->
<!-- FORMULAIRE DE RECHERCHE -->
<!----------------------------->
<form class="recherche" method="post" action="#">

    <!-- CHAMP DE RECHERCHE -->
    <label for="search">Rechercher un emprunt</label>
    <input type="text" id="search" name="search" placeholder="Rechercher...">

    <!-- BOUTON D'ENVOI -->
    <input type="submit" value="Lancer la recherche">
</form>

<!------------------------>
<!-- TABLEAU DES LIVRES -->
<!------------------------>
<table>
    <caption>Liste des emprunts</caption>

    <!-- ENTETE DU TABLEAU -->
    <tr>
        <th>Utilisateur</th>
        <th>Livre</th>
        <th>Début</th>
        <th>Fin</th>
        <th></th>
    </tr>

    <?php

    // ALIMENTATION DU TABLEAU DES EMPRUNTS
    foreach ($emprunts as $emprunt) {
    ?>
        <tr>
            <td><?php echo $emprunt->getUtilisateur(); ?></td>
            <td><?php echo $emprunt->getLivre(); ?></td>
            <td><?php echo $emprunt->getDebut(); ?></td>
            <td><?php echo $emprunt->getFin(); ?></td>
            <td class="derniereColonne emprunt">
                
                <?php 
                if ($emprunt->getFin()) {
                    echo "<span>Restitué</Span>";
                } else {
                    echo "<a href='index.php?page=restituer_emprunt&id_emprunt=" . $emprunt->getIDemprunt() . "&id_livre=" . $emprunt->getIDlivre() . "'>A restituer</a>";
                }
                ?>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
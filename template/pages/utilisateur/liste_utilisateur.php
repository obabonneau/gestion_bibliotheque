<?php

////////////////////////////////
// RECHERCHE D'UN UTILISATEUR //
////////////////////////////////

// RECUPERATION, VALIDATION DU PARAMETRE "search" si lien conforme dans liste_utilisateur.php
$search = $_POST['search'] ?? null;

if ($search) {
    $search = "%" . $search . "%"; // Nécessaire pour lancer la recherche en bdd

    // INSTANCIATION D'UN OBJET "searchUtilisateur"
    $searchUtilisateur = new Utilisateurs();

    // UTILISATION DE LA METHODE "search" DE L'OBJET
    $utilisateurs = $searchUtilisateur->searchUtilisateur($search);

    if (!$utilisateurs) {
        $utilisateurs[0] = new Utilisateurs();
        $utilisateurs[0]->setIDutilisateur("0");
        $utilisateurs[0]->setPrenom("...");
        $utilisateurs[0]->setNom("...");
        $utilisateurs[0]->setMail("...");
    }
} else {

    //////////////////////////////
    // LECTURE DES UTILISATEURS //
    //////////////////////////////

    // INSTANCIATION D'UN OBJET "readUtilisateurs"
    $readUtilisateurs = new Utilisateurs();

    // UTILISATION DE LA METHODE "read" DE L'OBJET
    $utilisateurs = $readUtilisateurs->readUtilisateurs();
}
?>

<!----------------------------->
<!-- FORMULAIRE DE RECHERCHE -->
<!----------------------------->
<form class="recherche" method="post" action="#">

    <!-- CHAMP DE RECHERCHE -->
    <label for="search">Rechercher un utilisateur</label>
    <input type="text" id="search" name="search" placeholder="Rechercher...">

    <!-- BOUTON D'ENVOI -->
    <input type="submit" value="Lancer la recherche">
</form>

<!------------------------------>
<!-- TABLEAU DES UTILISATEURS -->
<!------------------------------>
<table>
    <caption>Liste des utilisateurs</caption>

    <!-- ENTETE DU TABLEAU -->
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Mail</th>
        <th></th>
    </tr>

    <?php

    // ALIMENTATION DU TABLEAU DES UTILISATEURS
    foreach ($utilisateurs as $utilisateur) {
    ?>
        <tr>
            <td><?php echo $utilisateur->getPrenom(); ?></td>
            <td><?php echo $utilisateur->getNom(); ?></td>
            <td><?php echo $utilisateur->getMail(); ?></td>
            <td class="derniereColonne">
                <a href="index.php?page=formulaire_utilisateur&id_utilisateur=<?php echo $utilisateur->getIDutilisateur(); ?>"><i class='fa-solid fa-pen-to-square'></i></a> /
                <a href="index.php?page=delete_utilisateur&id_utilisateur=<?php echo $utilisateur->getIDutilisateur(); ?>"><i class='fa-solid fa-trash'></i></a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
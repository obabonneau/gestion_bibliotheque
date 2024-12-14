<?php

// DESACTIVATION DU FORMULAIRE
$formulaire = false; 

///////////////////////////////
// CREATION D'UN UTILISATEUR //
///////////////////////////////

// RECUPERATION, VALIDATION DU PARAMETRE "CREATE" si lien conforme dans header.php
$param = $_GET['param'] ?? null;

if ($param == "create") {
    $formulaire = true; // On active le formulaire.

    // DEFINITION D'UN CONTENU VIERGE
    $titre = "Créer un utilisateur";
    $action = "index.php?page=create_utilisateur";

    $prenom= null;
    $nom = null;
    $mail = null;
} else {

    //////////////////////////////////
    // MISE A JOUR D'UN UTILISATEUR //
    //////////////////////////////////

    // RECUPERATION, VALIDATION DE L'UTILISATEUR A METTRE A JOUR si lien conforme dans liste_utilisateur.php
    $idUtilisateur = $_GET['id_utilisateur'] ?? null;
    
    if ($idUtilisateur) {

        // INSTANCIATION D'UN OBJET "readUtilisateur"
        $readUtilisateur = new Utilisateurs();

        // UTILISATION DE LA METHODE "read" DE L'OBJET
        $utilisateur = $readUtilisateur->readUtilisateur($idUtilisateur);

        if ($utilisateur) {
            $formulaire = true; // On active le formulaire.

            // RECUPERATION DU CONTENU DE L'UTILISATEUR
            $titre = "Modifier un utilisateur";
            $action = "index.php?page=update_utilisateur&id_utilisateur=" . $utilisateur->getIDutilisateur();
            $prenom = $utilisateur->getPrenom();
            $nom = $utilisateur->getNom();
            $mail = $utilisateur->getMail();
        }
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
    <form method="post" action="<?php echo $action; ?>">

        <!-- CHAMPS -->
        <div class="champ">

            <!-- CHAMP PRENOM -->
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>"><br>

            <!-- CHAMP NOM -->
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>"><br>

            <!-- CHAMP MAIL -->
            <label for="mail">Mail</label>
            <input type="email" id="mail" name="mail" value="<?php echo $mail; ?>">
        </div>

        <!-- BOUTON D'ENVOI -->
        <input type="submit" value="Valider">

    </form>

<?php
} else {
    echo "<h2>Erreur lors de la génération du formulaire !</h2>";
}
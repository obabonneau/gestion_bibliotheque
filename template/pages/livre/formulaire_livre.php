<?php

// DESACTIVATION DU FORMULAIRE
$formulaire = false; 

/////////////////////////
// CREATION D'UN LIVRE //
/////////////////////////

// RECUPERATION, VALIDATION DU PARAMETRE "CREATE" si lien conforme dans header.php
$param = $_GET['param'] ?? null;

if ($param == "create") {
    $formulaire = true; // On active le formulaire.

    // DEFINITION D'UN CONTENU VIERGE
    $headTitre = "Créer un livre";
    $action = "index.php?page=create_livre";

    $titre = null;
    $auteur = null;
    $genre = null;
    $annee = null;
} else {

    ////////////////////////////
    // MISE A JOUR D'UN LIVRE //
    ////////////////////////////

    // RECUPERATION, VALIDATION DU LIVRE A METTRE A JOUR si lien conforme dans liste_livre.php
    $idLivre = $_GET['id_livre'] ?? null;
    
    if ($idLivre) {

        // INSTANCIATION D'UN OBJET "readLivre"
        $readLivre = new Livres();

        // UTILISATION DE LA METHODE "read" DE L'OBJET
        $livre = $readLivre->readLivre($idLivre);

        if ($livre) {
            $formulaire = true; // On active le formulaire.

            // RECUPERATION DU CONTENU DU LIVRE
            $headTitre = "Modifier un livre";
            $action = "index.php?page=update_livre&id_livre=" . $livre->getIDlivre() . "&etat=" . $livre->getEtat();
            $titre = $livre->getTitre();
            $auteur = $livre->getAuteur();
            $genre = $livre->getGenre();
            $annee = $livre->getAnnee();
        }
    }
}

/////////////////////////////
// AFFICHAGE DU FORMULAIRE //
/////////////////////////////

if ($formulaire) {
?>

    <!-- TITRE DE LA PAGE -->
    <h1><?php echo $headTitre ?></h1>

    <!-- FORMULAIRE -->
    <form method="post" action="<?php echo $action; ?>">

        <!-- CHAMPS -->
        <div class="champ">

            <!-- CHAMP TITRE -->
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="<?php echo $titre; ?>"><br>

            <!-- CHAMP AUTEUR -->
            <label for="auteur">Auteur</label>
            <input type="text" id="auteur" name="auteur" value="<?php echo $auteur; ?>"><br>

            <!-- CHAMP GENRE -->
            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre" value="<?php echo $genre; ?>"><br>

            <!-- CHAMP ANNEE -->
            <label for="annee">Annee</label>
            <input type="number" id="annee" name="annee" value="<?php echo $annee; ?>">
        </div>

        <!-- BOUTON D'ENVOI -->
        <input type="submit" value="Valider">

    </form>

<?php
} else {
    echo "<h2>Erreur lors de la génération du formulaire !</h2>";
}
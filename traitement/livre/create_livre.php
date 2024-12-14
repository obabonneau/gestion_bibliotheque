<?php

////////////////////////////////
// CREATION D'UN LIVRE EN BDD //
////////////////////////////////

// VERIFICATION DE L'UTILISATION DE LA METHODE POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme dans formulaire_livre.php
    $titre = $_POST['titre'] ?? null;
    $auteur = $_POST['auteur'] ?? null;
    $genre = $_POST['genre'] ?? null;
    $annee = $_POST['annee'] ?? null;

    if ($titre && $auteur && $genre && $annee) {
        
        // INSTANCIATION D'UN OBJET "newLivre"
        $newLivre = new Livres();

        // PASSAGE DES CHAMPS AVEC SETTER
        $newLivre->setTitre($titre);
        $newLivre->setAuteur($auteur);
        $newLivre->setGenre($genre);
        $newLivre->setAnnee($annee);
        $newLivre->setEtat(false);

        // UTILISATION DE LA METHODE "create" DE l'OBJET
        // RECUPERATION DE l'ACCUSE D'EXECUTION
        $ack = $newLivre->createLivre();

        if ($ack) {
            echo "<h2>Livre crée avec succès !</h2>";
        } else {
            echo "<h2>Erreur lors de la création du livre !</h2>";
        }
    } else {
        echo "<h2>Paramètre non spécifié ou manquant !</h2>";
    }
}  
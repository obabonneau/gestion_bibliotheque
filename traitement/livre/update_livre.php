<?php

///////////////////////////////////
// MISE A JOUR D'UN LIVRE EN BDD //
///////////////////////////////////

// RECUPERATION, VALIDATION D'UN LIVRE SELECTIONNE si lien conforme dans liste_livre.php
$idLivre = $_GET['id_livre'] ?? null;

if ($idLivre) {

    // RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme dans formulaire_livre.php   
    $titre = $_POST['titre'] ?? null;
    $auteur = $_POST['auteur'] ?? null;
    $genre = $_POST['genre'] ?? null;
    $annee = $_POST['annee'] ?? null;
    $etat = $_GET['etat'] ?? null;

    if ($titre && $auteur && $genre && $annee) { 

        // INSTANCIATION D'UN OBJET "majULivre"
        $majLivre = new Livres();

        // PASSAGE DES CHAMPS AVEC SETTER
        $majLivre->setIDlivre($idLivre);
        $majLivre->setTitre($titre);
        $majLivre->setAuteur($auteur);
        $majLivre->setGenre($genre);
        $majLivre->setAnnee($annee);
        $majLivre->setEtat($etat);

        // UTILISATION DE LA METHODE "update" DE l'OBJET
        // RECUPERATION DE l'ACCUSE D'EXECUTION
        $ack = $majLivre->updateLivre();

        if ($ack) {
            echo "<h2>Livre mise à jour avec succès !</h2>";
        } else {
            echo "<h2>Erreur lors de la mise à jour du livre !</h2>";
        }
    } else {
        echo "<h2>Paramètres non spécifiés ou manquants !</h2>";
    }
}
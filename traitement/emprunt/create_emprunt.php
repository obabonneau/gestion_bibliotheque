<?php

//////////////////////////////////
// CREATION D'UN EMPRUNT EN BDD //
//////////////////////////////////

// VERIFICATION DE L'UTILISATION DE LA METHODE POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme dans formulaire_emprunt.php
    $idUtilisateur = $_POST['utilisateur'] ?? null;
    $idTitre = $_POST['titre'] ?? null;

    if ($idUtilisateur && $idTitre) {
        
        // INSTANCIATION D'UN OBJET "newEmprunt"
        $newEmprunt = new Emprunts();

        // PASSAGE DES CHAMPS AVEC SETTER
        $newEmprunt->setIDutilisateur($idUtilisateur);
        $newEmprunt->setIDlivre($idTitre);

        // UTILISATION DE LA METHODE "create" DE l'OBJET
        // RECUPERATION DE l'ACCUSE D'EXECUTION
        $ack = $newEmprunt->createEmprunt();

        if ($ack) {
            echo "<h2>Emprunt crée avec succès !</h2>";
        } else {
            echo "<h2>Erreur lors de la création de l'emprunt !</h2>";
        }
    } else {
        echo "<h2>Paramètre non spécifié ou manquant !</h2>";
    }
}  
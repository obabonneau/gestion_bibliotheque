<?php

//////////////////////////////////
// RESTITUTER UN EMPRUNT EN BDD //
//////////////////////////////////

// RECUPERATION, VALIDATION DE L'EMPRUNT SELECTIONNE si lien conforme dans liste_emprunt.php
$idEmprunt = $_GET['id_emprunt'] ?? null;
$idLivre = $_GET['id_livre'] ?? null;

if ($idEmprunt && $idLivre) {

    // INSTANCIATION D'UN OBJET "majEmprunt"
    $majEmprunt = new Emprunts();

    // UTILISATION DE LA METHODE "restituer" DE l'OBJET
    // RECUPERATION DE l'ACCUSE D'EXECUTION
    $ack = $majEmprunt->restoreEmprunt($idEmprunt, $idLivre);

    if ($ack) {
        echo "<h2>Emprunt restitué avec succès !</h2>";
    } else {
        echo "<h2>Erreur lors de la restitution de l'emprunt !</h2>";
    }
} else {
    echo "<h2>Paramètres non spécifiés ou manquants !</h2>";  
}
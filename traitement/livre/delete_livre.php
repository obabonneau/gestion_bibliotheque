<?php

///////////////////////////////////
// SUPPRESSION D'UN LIVRE EN BDD //
///////////////////////////////////

// RECUPERATION, VALIDATION DE l'UTILISATEUR SELECTIONNE si lien conforme dans liste_livre.php
$idLivre = $_GET['id_livre'] ?? null;

if ($idLivre) {

    // INSTANCIATION D'UN OBJET "delLivre"
    $delLivre = new Livres();

    // UTILISATION DE LA METHODE "delete" DE l'OBJET
    // RECUPERATION DE l'ACCUSE D'EXECUTION
    $ack = $delLivre->deleteLivre($idLivre);

    if ($ack) {
        echo "<h2>Livre supprimé avec succès !</h2>";
    } else {
        echo "<h2>Erreur lors de la suppression du livre !</h2>";
    }
} else {
    echo "<h2>Paramètre non spécifié ou manquant !</h2>";
}
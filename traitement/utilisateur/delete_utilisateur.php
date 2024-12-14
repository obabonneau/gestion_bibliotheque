<?php

/////////////////////////////////////////
// SUPPRESSION D'UN UTILISATEUR EN BDD //
/////////////////////////////////////////

// RECUPERATION, VALIDATION DE l'UTILISATEUR SELECTIONNE si lien conforme dans liste_utilisateur.php
$idUtilisateur = $_GET['id_utilisateur'] ?? null;

if ($idUtilisateur) {

    // INSTANCIATION D'UN OBJET "delUtilisateur"
    $delUtilisateur = new Utilisateurs();

    // UTILISATION DE LA METHODE "delete" DE l'OBJET
    // RECUPERATION DE l'ACCUSE D'EXECUTION
    $ack = $delUtilisateur->deleteUtilisateur($idUtilisateur);

    if ($ack) {
        echo "<h2>Utilisateur supprimé avec succès !</h2>";
    } else {
        echo "<h2>Erreur lors de la suppression de l'utilisateur !</h2>";
    }
} else {
    echo "<h2>Paramètre non spécifié ou manquant !</h2>";
}
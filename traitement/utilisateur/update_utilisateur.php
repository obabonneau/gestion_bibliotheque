<?php

/////////////////////////////////////////
// MISE A JOUR D'UN UTILISATEUR EN BDD //
/////////////////////////////////////////

// RECUPERATION, VALIDATION D'UN UTILISATEUR SELECTIONNE si lien conforme dans liste_utilisateur.php
$idUtilisateur = $_GET['id_utilisateur'] ?? null;

if ($idUtilisateur) {

    // RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme dans formulaire_utilisateur.php
    $prenom = $_POST['prenom'] ?? null;
    $nom = $_POST['nom'] ?? null;
    $mail = $_POST['mail'] ?? null;

    if ($prenom && $nom && $mail) {

        // INSTANCIATION D'UN OBJET "majUtilisateur"
        $majUtilisateur = new Utilisateurs();

        // PASSAGE DES CHAMPS AVEC SETTER
        $majUtilisateur->setIDutilisateur($idUtilisateur);
        $majUtilisateur->setPrenom($prenom);
        $majUtilisateur->setNom($nom);
        $majUtilisateur->setMail($mail);

        // UTILISATION DE LA METHODE "update" DE l'OBJET
        // RECUPERATION DE l'ACCUSE D'EXECUTION
        $ack = $majUtilisateur->updateUtilisateur();

        if ($ack) {
            echo "<h2>Utilisateur mise à jour avec succès !</h2>";
        } else {
            echo "<h2>Erreur lors de la mise à jour de l'utilisateur !</h2>";
        }
    } else {
        echo "<h2>Paramètres non spécifiés ou manquants !</h2>";
    }
}

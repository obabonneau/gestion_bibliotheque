<?php

//////////////////////////////////////
// CREATION D'UN UTILISATEUR EN BDD //
//////////////////////////////////////

// VERIFICATION DE L'UTILISATION DE LA METHODE POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme dans formulaire_utilisateur.php
    $prenom = $_POST['prenom'] ?? null;
    $nom = $_POST['nom'] ?? null;
    $mail = $_POST['mail'] ?? null;

    if ($prenom && $nom && $mail) {
        
        // INSTANCIATION D'UN OBJET "newUtilisateur"
        $newUtilisateur = new Utilisateurs();

        // PASSAGE DES CHAMPS AVEC SETTER
        $newUtilisateur->setPrenom($prenom);
        $newUtilisateur->setNom($nom);
        $newUtilisateur->setMail($mail);

        // UTILISATION DE LA METHODE "create" DE l'OBJET
        // RECUPERATION DE l'ACCUSE D'EXECUTION
        $ack = $newUtilisateur->createUtilisateur();

        if ($ack) {
            echo "<h2>Utilisateur crée avec succès !</h2>";
        } else {
            echo "<h2>Erreur lors de la création de l'utilisateur !</h2>";
        }
    } else {
        echo "<h2>Paramètre non spécifié ou manquant !</h2>";
    }
}  
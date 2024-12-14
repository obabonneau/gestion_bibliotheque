<?php

// UTILISATION DES CLASSES suivantes
include "classes/DbConnect.php";
include "classes/Utilisateurs.php";
include "classes/Livres.php";
include "classes/Emprunts.php";

// INTEGRATION DE LA PAGE header
include "template/layout/header.php";

// RECUPERATION, SWITCH VERS LA PAGE
$page = $_GET["page"] ?? "home";

switch ($page) {

    // LES PAGES DU SITE
    case "home":
        include "template/pages/home.php";
        break;

    case "liste_utilisateur":
        include "template/pages/utilisateur/liste_utilisateur.php";
        break;

    case "formulaire_utilisateur":
        include "template/pages/utilisateur/formulaire_utilisateur.php";
        break;

    case "liste_livre":
        include "template/pages/livre/liste_livre.php";
        break;
    
    case "formulaire_livre":
        include "template/pages/livre/formulaire_livre.php";
        break;

    case "liste_emprunt":
        include "template/pages/emprunt/liste_emprunt.php";
        break;

    case "formulaire_emprunt":
        include "template/pages/emprunt/formulaire_emprunt.php";
        break; 

    // LES PAGES DE TRAITEMENT
    case "delete_utilisateur":
        include "traitement/utilisateur/delete_utilisateur.php";
        break;

    case "create_utilisateur":
            include "traitement/utilisateur/create_utilisateur.php";
            break;

    case "update_utilisateur":
        include "traitement/utilisateur/update_utilisateur.php";
        break;

    case "delete_livre":
        include "traitement/livre/delete_livre.php";
        break;
    
    case "create_livre":
        include "traitement/livre/create_livre.php";
        break;
    
    case "update_livre":
        include "traitement/livre/update_livre.php";
        break;

    case "create_emprunt":
        include "traitement/emprunt/create_emprunt.php";
        break;

    case "restituer_emprunt":
        include "traitement/emprunt/restituer_emprunt.php";
        break;

    // LA PAGE PAGE PAR DEFAUT
    default:
        include "template/pages/home.php";
        break;
}

// INTEGRATION DE LA PAGE footer
include "template/layout/footer.php";
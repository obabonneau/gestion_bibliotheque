<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de bibliothèque</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/c245ee9b98.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id=wrapper>
        <header class="entete">
            <a href="index.php">GESTION DE BIBLIOTHEQUE</a>
        </header>

        <main>
            <nav>
                <ul class="menu">
                    <li class="menuDeroulant">
                        <a href="#">UTILISATEURS</a>
                        <ul class="sousMenu">
                            <li><a href="index.php?page=liste_utilisateur"><i class="fa-solid fa-list"></i> Liste des utilisateurs</a></li>
                            <li><a href="index.php?page=formulaire_utilisateur&param=create"><i class="fa-solid fa-arrow-up-right-from-square"></i> Créer un utilisateur</a></li>
                        </ul>
                    </li>

                    <li class="menuDeroulant">
                        <a href="#">LIVRES</a>
                        <ul class="sousMenu">
                            <li><a href="index.php?page=liste_livre"><i class="fa-solid fa-list"></i> Liste des livres</a></li>
                            <li><a href="index.php?page=formulaire_livre&param=create"><i class="fa-solid fa-arrow-up-right-from-square"></i> Créer un livre</a></li>
                        </ul>
                    </li>

                    <li class="menuDeroulant">
                        <a href="#">EMPRUNTS</a>
                        <ul class="sousMenu">
                            <li><a href="index.php?page=liste_emprunt"><i class="fa-solid fa-list"></i> Liste des emprunts</a></li>
                            <li><a href="index.php?page=formulaire_emprunt"><i class="fa-solid fa-arrow-up-right-from-square"></i> Créer un emprunt</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
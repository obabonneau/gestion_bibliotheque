<?php

//////////////////////////////
// LECTURE DES UTILISATEURS //
//////////////////////////////

// INSTANCIATION D'UN OBJET "readUtilisateurs"
$readUtilisateurs = new Utilisateurs();

// UTILISATION DE LA METHODE "read" DE L'OBJET
$utilisateurs = $readUtilisateurs->readUtilisateurs();

////////////////////////
// LECTURE DES LIVRES //
////////////////////////

// INSTANCIATION D'UN OBJET "readLivres"
$readLivres = new Livres();

// UTILISATION DE LA METHODE "readDispo" DE L'OBJET
$livres = $readLivres->readLivresDispo(true);

/////////////////////////////
// AFFICHAGE DU FORMULAIRE //
/////////////////////////////
?>
<!-- TITRE DE LA PAGE -->
<h1>Créer un emprunt</h1>

<!-- FORMULAIRE -->
<form method="post" action="index.php?page=create_emprunt">

    <!-- CHAMPS -->
    <div class="champ">

        <!-- CHAMP UTILISATEUR -->
        <label for="utilisateur">Utilisateur</label>
        <select id="utilisateur" name="utilisateur">
            <?php

            // ALIMENTATION DU MENU DEROULANT AVEC LA LISTE DES UTILISATEURS       
            foreach ($utilisateurs as $utilisateur) {
                echo "<option value=" . $utilisateur->getIDutilisateur() . ">" . $utilisateur->getPrenom() . " " . $utilisateur->getNom() . "</option>";
            }
            ?>
        </select><br>

        <!-- CHAMP TITRE -->
        <label for="titre">Titre</label>
        <select id="titre" name="titre">
            <?php

            // ALIMENTATION DU MENU DEROULANT AVEC LA LISTE DES LIVRES DISPOS      
            foreach ($livres as $livre) {
                echo "<option value=" . $livre->getIDlivre() . ">" . $livre->getTitre() . "</option>";
            }
            ?>
        </select><br>
    </div>

    <!-- BOUTON D'ENVOI -->
    <input type="submit" value="Valider">

</form>
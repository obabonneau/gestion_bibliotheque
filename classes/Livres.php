<?php

/////////////////////////
// CLASS ET BDD LIVRES //
/////////////////////////

class Livres extends DbConnect
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $idLivre;
    private $titre;
    private $auteur;
    private $genre;
    private $annee;
    private $etat;

    //////////////////////////////////////
    // METHODE POUR RECHERCHER UN LIVRE //
    //////////////////////////////////////
    public function searchLivre($search)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("SELECT id_livre, titre, auteur, genre, annee, etat
                FROM livres
                WHERE livres.titre LIKE :search
                OR livres.auteur LIKE :search
                OR livres.genre LIKE :search
                OR livres.annee LIKE :search
                ORDER BY titre ASC");
            $requete->bindParam(':search', $search);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE EN TABLEAU
            $resultat = $requete->fetchall(PDO::FETCH_ASSOC);

            // PASSAGE DU TABLEAU DANS DES OBJETS
            $livres = [];
            foreach ($resultat as $cle => $livre) {
                $livres[$cle] = new Livres();
                $livres[$cle]->setIDlivre($livre['id_livre']);
                $livres[$cle]->setTitre($livre['titre']);
                $livres[$cle]->setAuteur($livre['auteur']);
                $livres[$cle]->setGenre($livre['genre']);
                $livres[$cle]->setAnnee($livre['annee']);
                $livres[$cle]->setEtat($livre['etat']);
            }

            // RETOUR DES LIVRES
            return $livres;

        } catch (PDOException $e) {
            //echo "<p>ERREUR DE LECTURE SQL: " . $e->getMessage() . "</p>";
        }
    }

    /////////////////////////////////////
    // METHODE POUR RECUPERER UN LIVRE //
    /////////////////////////////////////
    public function readLivre($idLivre)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("SELECT * FROM livres WHERE id_livre = :id_livre");
            $requete->bindParam(':id_livre', $idLivre);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);

            // PASSAGE DU RESULTAT DANS UN OBJET
            $livre = new Livres();
            $livre->setIDlivre($resultat['id_livre']);
            $livre->setTitre($resultat['titre']);
            $livre->setAuteur($resultat['auteur']);
            $livre->setGenre($resultat['genre']);
            $livre->setAnnee($resultat['annee']);
            $livre->setEtat($resultat['etat']);

            // RETOUR D'UN LIVRE
            return $livre;
            
        } catch (PDOException $e) {
            //echo "<p>ERREUR DE LECTURE SQL: " . $e->getMessage() . "</p>";
        }
    }

    ///////////////////////////////////////
    // METHODE POUR RECUPERER DES LIVRES //
    ///////////////////////////////////////
    public function readLivres()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("SELECT * FROM livres ORDER BY titre ASC");

            // EXECUTION DE LA REQUETE SQL EN TABLEAU
            $requete->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            // PASSAGE DU TABLEAU DANS DES OBJETS
            $livres = [];
            foreach ($resultat as $cle => $livre) {
                $livres[$cle] = new Livres();
                $livres[$cle]->setIDlivre($livre['id_livre']);
                $livres[$cle]->setTitre($livre['titre']);
                $livres[$cle]->setAuteur($livre['auteur']);
                $livres[$cle]->setGenre($livre['genre']);
                $livres[$cle]->setAnnee($livre['annee']);
                $livres[$cle]->setEtat($livre['etat']);
            }

            // RETOUR DES LIVRES
            return $livres;

        } catch (PDOException $e) {
            //echo 'Erreur:' . $e->getMessage();
        }
    }

    /////////////////////////////////////
    // METHODE POUR RECUPERER UN LIVRE //
    /////////////////////////////////////
    public function readLivresDispo($etat)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("SELECT * FROM livres WHERE etat = :etat");
            $requete->bindParam(':etat', $etat);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            // PASSAGE DU TABLEAU DANS DES OBJETS
            $livres = [];
            foreach ($resultat as $cle => $livre) {
                $livres[$cle] = new Livres();
                $livres[$cle]->setIDlivre($livre['id_livre']);
                $livres[$cle]->setTitre($livre['titre']);
                $livres[$cle]->setAuteur($livre['auteur']);
                $livres[$cle]->setGenre($livre['genre']);
                $livres[$cle]->setAnnee($livre['annee']);
                $livres[$cle]->setEtat($livre['etat']);
            }

            // RETOUR D'UN LIVRE
            return $livres;
            
        } catch (PDOException $e) {
            //echo "<p>ERREUR DE LECTURE SQL: " . $e->getMessage() . "</p>";
        }
    }

    /////////////////////////////////
    // METHODE POUR CREER UN LIVRE //
    /////////////////////////////////
    public function createLivre()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("INSERT INTO livres (titre, auteur, genre, annee, etat)
                VALUES (:titre, :auteur, :genre, :annee, :etat)");
            $requete->bindParam(':titre', $this->titre);
            $requete->bindParam(':auteur', $this->auteur);
            $requete->bindParam(':genre', $this->genre);
            $requete->bindParam(':annee', $this->annee);
            $requete->bindParam(':etat', $this->etat);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();
            $this->ack = true;

        } catch (PDOException $e) {
            //echo "<p>ERREUR DE CREATION SQL: " . $e->getMessage() . "</p>";
            $this->ack = false;
        }
        
        // RETOUR D'UN ACCUSE DE TRAITEMENT
        return $this->ack;
    }

    /////////////////////////////////////////
    // METHODE POUR METTRE A JOUR UN LIVRE //
    /////////////////////////////////////////
    public function updateLivre()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("UPDATE livres SET
                titre = :titre,
                auteur = :auteur,
                genre = :genre,
                annee = :annee,
                etat = :etat
                WHERE id_livre = :id_livre");
            $requete->bindParam(':id_livre', $this->idLivre);
            $requete->bindParam(':titre', $this->titre);
            $requete->bindParam(':auteur', $this->auteur);
            $requete->bindParam(':genre', $this->genre);
            $requete->bindParam(':annee', $this->annee);
            $requete->bindParam(':etat', $this->etat);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();
            $this->ack = true;

        } catch (PDOException $e) {
            //echo "<p>ERREUR DE MAJ SQL: " . $e->getMessage() . "</p>";
            $this->ack = false;
        }

        // RETOUR D'UN ACCUSE DE TRAITEMENT
        return $this->ack;
    }

    /////////////////////////////////////
    // METHODE POUR SUPPRIMER UN LIVRE //
    /////////////////////////////////////
    public function deleteLivre($idLivre)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("DELETE FROM livres WHERE id_livre = :id_livre");
            $requete->bindParam(':id_livre', $idLivre);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();
            $this->ack = true;

        } catch (PDOException $e) {
            //echo "<p>ERREUR DE SUPPRESION SQL: " . $e->getMessage() . "</p>";
            $this->ack = false;
        }

        // RETOUR D'UN ACCUSE DE TRAITEMENT
        return $this->ack;
    }

    ////////////////////
    // METHODE SETTER //
    ////////////////////
    public function setIDlivre($idLivre)
    {
        $this->idLivre = $idLivre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    ////////////////////
    // METHODE GETTER //
    ////////////////////
    public function getIDLivre()
    {
        return $this->idLivre;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function getEtat()
    {
        return $this->etat;
    }
}
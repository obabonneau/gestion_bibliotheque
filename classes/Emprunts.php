<?php

///////////////////////////
// CLASS ET BDD EMPRUNTS //
///////////////////////////

class Emprunts extends DbConnect
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $idEmprunt;
    private $idLivre;
    private $idUtilisateur;
    private $debut;
    private $fin;
    private $utilisateur;
    private $livre;

    ////////////////////////////////////////
    // METHODE POUR RECHERCHER UN EMPRUNT //
    ////////////////////////////////////////
    public function searchEmprunt($search) {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("SELECT utilisateurs.prenom, utilisateurs.nom, emprunts.id_emprunt, emprunts.debut, emprunts.fin, livres.id_livre, livres.titre
                FROM utilisateurs 
                INNER JOIN emprunts ON utilisateurs.id_utilisateur = emprunts.id_utilisateur
                INNER JOIN livres ON emprunts.id_livre = livres.id_livre
                WHERE utilisateurs.prenom LIKE :search
                OR utilisateurs.nom LIKE :search
                OR livres.titre LIKE :search
                ORDER BY debut DESC");
            $requete->bindParam(':search', $search);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE EN TABLEAU
            $resultat = $requete->fetchall(PDO::FETCH_ASSOC);

            // PASSAGE DU TABLEAU DANS DES OBJETS
            $emprunts = [];
            foreach ($resultat as $cle => $emprunt) {
                $emprunts[$cle] = new Emprunts();
                $emprunts[$cle]->setIDemprunt($emprunt['id_emprunt']);
                $emprunts[$cle]->setIDlivre($emprunt['id_livre']);
                $emprunts[$cle]->setUtilisateur($emprunt['prenom'] . " " . $emprunt['nom'] );
                $emprunts[$cle]->setLivre($emprunt['titre']);
                $emprunts[$cle]->setDebut($emprunt['debut']);
                $emprunts[$cle]->setFin($emprunt['fin']);
            }

            // RETOUR DES LIVRES
            return $emprunts;

        } catch (PDOException $e) {
            //echo "<p>ERREUR DE LECTURE SQL: " . $e->getMessage() . "</p>";
        }
    }

    /////////////////////////////////////////
    // METHODE POUR RECUPERER DES EMPRUNTS //
    /////////////////////////////////////////
    public function readEmprunts()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("SELECT utilisateurs.prenom, utilisateurs.nom, emprunts.id_emprunt, emprunts.debut, emprunts.fin, livres.id_livre, livres.titre
                FROM utilisateurs 
                INNER JOIN emprunts ON utilisateurs.id_utilisateur = emprunts.id_utilisateur
                INNER JOIN livres ON emprunts.id_livre = livres.id_livre
                ORDER BY debut DESC");

            // EXECUTION DE LA REQUETE SQL EN TABLEAU
            $requete->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            // PASSAGE DU TABLEAU DANS DES OBJETS
            $emprunts = [];
            foreach ($resultat as $cle => $emprunt) {
                $emprunts[$cle] = new Emprunts();  
                $emprunts[$cle]->setIDemprunt($emprunt['id_emprunt']);
                $emprunts[$cle]->setIDLivre($emprunt['id_livre']);
                $emprunts[$cle]->setUtilisateur($emprunt['prenom'] . " " . $emprunt['nom'] );
                $emprunts[$cle]->setLivre($emprunt['titre']);
                $emprunts[$cle]->setDebut($emprunt['debut']);
                $emprunts[$cle]->setFin($emprunt['fin']);
            }

            // RETOUR DES EMPRUNTS
            return $emprunts;

        } catch (PDOException $e) {
            //echo "<p>ERREUR DE LECTURE SQL: " . $e->getMessage() . "</p>";
        }
    }

    ///////////////////////////////////
    // METHODE POUR CREER UN EMPRUNT //
    ///////////////////////////////////
    public function createEmprunt()
    {
        // DEFINITION DES ATTRIBUTS
        $this->debut = date('Y-m-d');
        $this->fin = null;

        ///////////////////////////
        // CREATION DE L'EMPRUNT //
        ///////////////////////////
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("INSERT INTO emprunts (id_utilisateur, id_livre, debut, fin)
                VALUES (:id_utilisateur, :id_livre, :debut, :fin)");
            $requete->bindParam(':id_utilisateur', $this->idUtilisateur);
            $requete->bindParam(':id_livre', $this->idLivre);
            $requete->bindParam(':debut', $this->debut);
            $requete->bindParam(':fin', $this->fin);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();

            /////////////////////////////////////
            // MODIFICATION DU STATUT DU LIVRE //
            /////////////////////////////////////
            try {
                // PREPARATION DE LA REQUETE SQL
                $requete = $this->connexion->prepare("UPDATE livres SET etat = 0 WHERE id_livre = :id_livre");
                $requete->bindParam(':id_livre', $this->idLivre);

                // EXECUTION DE LA REQUETE SQL
                $requete->execute();
                $this->ack = true;
                
            } catch (PDOException $e) {
                //echo "<p>ERREUR DE MAJ SQL: " . $e->getMessage() . "</p>";
                $this->ack = false;
            }
        } catch (PDOException $e) {
            //echo "<p>ERREUR DE CREATION SQL: " . $e->getMessage() . "</p>";
            $this->ack = false;
        }

        // RETOUR D'UN ACCUSE DE TRAITEMENT
        return $this->ack;
    }

    ///////////////////////////////////
    // METHODE POUR CREER UN EMPRUNT //
    ///////////////////////////////////
    public function restoreEmprunt($idEmprunt, $idLivre)
    {
        // DEFINITION DES ATTRIBUTS
        $this->fin = date('Y-m-d');

        //////////////////////////////
        // RESTITUTION DE L'EMPRUNT //
        //////////////////////////////
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("UPDATE emprunts SET fin = :fin
                WHERE id_emprunt = :id_emprunt");
            $requete->bindParam(':id_emprunt', $idEmprunt);
            $requete->bindParam(':fin', $this->fin);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();

            /////////////////////////////////////
            // MODIFICATION DU STATUT DU LIVRE //
            /////////////////////////////////////
            try {
                // PREPARATION DE LA REQUETE SQL
                $requete = $this->connexion->prepare("UPDATE livres SET etat = 1 WHERE id_livre = :id_livre");
                $requete->bindParam(':id_livre', $idLivre);

                // EXECUTION DE LA REQUETE SQL
                $requete->execute();
                $this->ack = true;
                
            } catch (PDOException $e) {
                //echo "<p>ERREUR DE MAJ SQL: " . $e->getMessage() . "</p>";
                $this->ack = false;
            }
        } catch (PDOException $e) {
            //echo "<p>ERREUR DE CREATION SQL: " . $e->getMessage() . "</p>";
            $this->ack = false;
        }

        // RETOUR D'UN ACCUSE DE TRAITEMENT
        return $this->ack;
    } 
    
    ////////////////////
    // METHODE SETTER //
    ////////////////////
    public function setIDemprunt($idEmprunt)
    {
        $this->idEmprunt = $idEmprunt;
    }

    public function setIDutilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setIDlivre($idLivre)
    {
        $this->idLivre = $idLivre;
    }

    public function setDebut($debut)
    {
        $this->debut = $debut;
    }

    public function setFin($fin)
    {
        $this->fin = $fin;
    }

    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    public function setLivre($livre)
    {
        $this->livre = $livre;
    }

    ////////////////////
    // METHODE GETTER //
    ////////////////////
    public function getIDemprunt()
    {
        return $this->idEmprunt;
    }

    public function getIDutilisateur()
    {
        return $this->idUtilisateur;
    }

    public function getIDlivre()
    {
        return $this->idLivre;
    }

    public function getDebut()
    {
        return $this->debut;
    }

    public function getFin()
    {
        return $this->fin;
    }

    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    public function getLivre()
    {
        return $this->livre;
    }
}
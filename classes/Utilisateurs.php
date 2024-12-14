<?php

///////////////////////////////
// CLASS ET BDD UTILISATEURS //
///////////////////////////////

class Utilisateurs extends DbConnect
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $idUtilisateur;
    private $prenom;
    private $nom;
    private $mail;

    ////////////////////////////////////////////
    // METHODE POUR RECHERCHER UN UTILISATEUR //
    ////////////////////////////////////////////
    public function searchUtilisateur($search)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("SELECT id_utilisateur, prenom, nom, mail
                FROM utilisateurs
                WHERE utilisateurs.prenom LIKE :search
                OR utilisateurs.nom LIKE :search
                OR utilisateurs.mail LIKE :search
                ORDER BY nom ASC");
            $requete->bindParam(':search', $search);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE EN TABLEAU
            $resultat = $requete->fetchall(PDO::FETCH_ASSOC);

            // PASSAGE DU TABLEAU DANS DES OBJETS
            $utilisateurs = [];
            foreach ($resultat as $cle => $utilisateur) {
                $utilisateurs[$cle] = new Utilisateurs();
                $utilisateurs[$cle]->setIDutilisateur($utilisateur['id_utilisateur']);
                $utilisateurs[$cle]->setPrenom($utilisateur['prenom']);
                $utilisateurs[$cle]->setNom($utilisateur['nom']);
                $utilisateurs[$cle]->setMail($utilisateur['mail']);
            }

            // RETOUR DES UTILISATEURS
            return $utilisateurs;

        } catch (PDOException $e) {
            //echo "<p>ERREUR DE LECTURE SQL: " . $e->getMessage() . "</p>";
        }
    }

    ///////////////////////////////////////////
    // METHODE POUR RECUPERER UN UTILISATEUR //
    ///////////////////////////////////////////
    public function readUtilisateur($idUtilisateur)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur");
            $requete->bindParam(':id_utilisateur', $idUtilisateur);

            // EXECUTION DE LA REQUETE SQL
            $requete->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);

            // PASSAGE DU RESULTAT DANS UN OBJET
            $utilisateur = new Utilisateurs();
            $utilisateur->setIDutilisateur($resultat['id_utilisateur']);
            $utilisateur->setPrenom($resultat['prenom']);
            $utilisateur->setNom($resultat['nom']);
            $utilisateur->setMail($resultat['mail']);

            // RETOUR D'UN UTILISATEUR
            return $utilisateur;
            
        } catch (PDOException $e) {
            //echo "<p>ERREUR DE LECTURE SQL: " . $e->getMessage() . "</p>";
        }
    }

    /////////////////////////////////////////////
    // METHODE POUR RECUPERER DES UTILISATEURS //
    /////////////////////////////////////////////
    public function readUtilisateurs()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("SELECT * FROM utilisateurs ORDER BY nom ASC");

            // EXECUTION DE LA REQUETE SQL EN TABLEAU
            $requete->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            // PASSAGE DU TABLEAU DANS DES OBJETS
            $utilisateurs = [];
            foreach ($resultat as $cle => $utilisateur) {
                $utilisateurs[$cle] = new Utilisateurs();
                $utilisateurs[$cle]->setIDutilisateur($utilisateur['id_utilisateur']);
                $utilisateurs[$cle]->setPrenom($utilisateur['prenom']);
                $utilisateurs[$cle]->setNom($utilisateur['nom']);
                $utilisateurs[$cle]->setMail($utilisateur['mail']);
            }

            // RETOUR DES UTILISATEURS
            return $utilisateurs;

        } catch (PDOException $e) {
            //echo 'Erreur:' . $e->getMessage();
        }
    }

    ///////////////////////////////////////
    // METHODE POUR CREER UN UTILISATEUR //
    ///////////////////////////////////////
    public function createUtilisateur()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("INSERT INTO utilisateurs (prenom, nom, mail)
            VALUES (:prenom, :nom, :mail)");
            $requete->bindParam(':prenom', $this->prenom);
            $requete->bindParam(':nom', $this->nom);
            $requete->bindParam(':mail', $this->mail);

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

    ///////////////////////////////////////////////
    // METHODE POUR METTRE A JOUR UN UTILISATEUR //
    ///////////////////////////////////////////////
    public function updateUtilisateur()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("UPDATE utilisateurs SET
                prenom = :prenom,
                nom = :nom,
                mail = :mail
                WHERE id_utilisateur = :id_utilisateur");
            $requete->bindParam(':id_utilisateur', $this->idUtilisateur);
            $requete->bindParam(':prenom', $this->prenom);
            $requete->bindParam(':nom', $this->nom);
            $requete->bindParam(':mail', $this->mail);

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

    ///////////////////////////////////////////
    // METHODE POUR SUPPRIMER UN UTILISATEUR //
    ///////////////////////////////////////////
    public function deleteUtilisateur($idUtilisateur)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $requete = $this->connexion->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur");
            $requete->bindParam(':id_utilisateur', $idUtilisateur);

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
    public function setIDutilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    ////////////////////
    // METHODE GETTER //
    ////////////////////
    public function getIDutilisateur()
    {
        return $this->idUtilisateur;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getMail()
    {
        return $this->mail;
    }
}
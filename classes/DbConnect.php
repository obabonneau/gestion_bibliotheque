<?php

//////////////////////////////////////////////
// CLASSE DE CONNEXION A LA BASE DE DONNEES //
//////////////////////////////////////////////

abstract class DbConnect
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    protected $connexion;
    protected $ack = false;

    //////////////////////////////////////////////////
    // CONSTANTES DE CONNEXION A LA BASE DE DONNEES //
    //////////////////////////////////////////////////
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BASE = "gestion_bibliotheque";

    ////////////////////////////////////////////////
    // CONSTRUCTEUR POUR INITIALISER LA CONNEXION //
    ////////////////////////////////////////////////
    public function __construct()
    {
        try {
            // CRÉATION D'UNE INSTANCE PDO AVEC GESTION DES ERREURS EN MODE EXCEPTION
            $this->connexion = new PDO("mysql:host=" . self::SERVER . ";dbname=" . self::BASE, self::USER, self::PASSWORD);

            // DÉFINITION DU MODE DE GESTION DES ERREURS AVEC EXCEPTION
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (Exception $e) { //ou PDOException si on veut que les erreurs PDO
            //echo "<p>ERREUR DE CONNEXION SQL: " . $e->getMessage() . "</p>";
        }
    }
}

// new DbConnect();
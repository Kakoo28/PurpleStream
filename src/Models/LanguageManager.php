<?php

namespace PurpleStream\Models;

class LanguageManager
{
// Déclaration de l'attribut qui contient la connexion à la base de données
    private $connexion;

    // Constructeur de la classe
    public function __construct()
    {
        // Connexion à la base de données en utilisant les constantes définies dans le fichier désigné
        $this->connexion = new \PDO('mysql:host=' . DB_CONFIG["HOST"]. ';dbname=' . DB_CONFIG["DATABASE"] . ';charset=utf8;', DB_CONFIG["USER"], DB_CONFIG["PASSWORD"]);
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }


    /** Récupération de tous les services du language **/
    public function getAll()
    {
        // Requête pour récupérer tous les services
        $stmt = $this->connexion->prepare('SELECT * FROM langage');
        $stmt->execute();
        // Renvoie un tableau d'objets Service
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Language::class);
    }
}
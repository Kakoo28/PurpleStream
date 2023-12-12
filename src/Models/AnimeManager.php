<?php

namespace PurpleStream\Models;

class AnimeManager
{
    private $connexion;

    // Constructeur de la classe
    public function __construct()
    {
        // Connexion à la base de données
        $this->connexion = new \PDO('mysql:host=' . DB_CONFIG["HOST"]. ';dbname=' . DB_CONFIG["DATABASE"] . ';charset=utf8;', DB_CONFIG["USER"], DB_CONFIG["PASSWORD"]);
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function animePush(Anime $anime)
    {
        $stmt = $this->connexion->prepare("INSERT INTO anime (anime_name, anime_description, anime_image, language_id) VALUES (? ,?,?,?)");
        $stmt->execute(array(
            $anime->getAnimeName(),
            $anime->getAnimeDescription(),
            $anime->getAnimeImage(),
            $anime->getLanguageId()
        ));
        // Recuperation de l'id dans une variable
        $anime->setAnimeID( $this->connexion->lastInsertId());
        foreach ($anime->getCategories() as $category_id){
            $stmt = $this->connexion->prepare("INSERT INTO anime_cat (anime_id, category_id) VALUES (? ,?)");
            $stmt->execute(array(
                $anime->getAnimeID(),
                $category_id
            ));
        }
        // Renvoie l'ID de la dernière insertion
        return $this->connexion->lastInsertId();
    }

    public function getAll()
    {
        // Requête pour récupérer tous les animes
        $stmt = $this->connexion->prepare('SELECT * FROM anime');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Anime::class);
    }

}
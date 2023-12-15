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

    public function getAllCategories()
    {
        $stmt = $this->connexion->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Category::class);
    }

    public function getAllLanguages()
    {
        $stmt = $this->connexion->prepare("SELECT * FROM languages");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Language::class);
    }

    public function saveAnime(Anime $anime) 
    {
        $stmt = $this->connexion->prepare("INSERT INTO anime (language_id, anime_name, anime_description, anime_image) VALUES (?,?,?,?)");
        $stmt->execute(array(
            $anime->getAnimeLanguageID(),
            $anime->getAnimeName(),
            $anime->getAnimeDescription(),
            $anime->getAnimeImage()
        ));
    
        $animeId = $this->connexion->lastInsertId();
        $anime->setAnimeId($animeId);
        
        // Appeler la deuxième méthode pour insérer dans la table anime_cat
        $this->saveCategoriesAnime($animeId, $anime->getCategories());
    
        return $anime;
    }
    
    public function saveCategoriesAnime($animeId, $categoryIds)
    {
        // Insérer dans la table anime_cat pour chaque catégorie
        foreach ($categoryIds as $categoryId) {
            $stmt = $this->connexion->prepare("INSERT INTO anime_cat (anime_id, category_id) VALUES (?, ?)");
            $stmt->execute([$animeId, $categoryId]);
        }
    }
    

}
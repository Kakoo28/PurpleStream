<?php

namespace PurpleStream\Controllers;

use PurpleStream\Models\anime;
use PurpleStream\Models\AnimeManager;
use PurpleStream\Controllers\CategoryController;
class AnimeController
{

    private $animeManager;
    public function __construct()
    {
        $this->animeManager = new AnimeManager();
    }


    public function showcreateAnime(){
        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();
        $languageController = new LanguageController();
        $languages = $languageController->getAll();
        require VIEWS . 'FormCreateAnime.php';
    }

    public function createAnime(){
        $anime = new Anime();

        // Récupérer les catégories depuis le formulaire (supposons que le formulaire utilise un champ checkboxes)
        $selectedCategories = isset($_POST['categories']) ? $_POST['categories'] : array();

        // Assurez-vous de valider et nettoyer les données reçues si nécessaire (par exemple, htmlspecialchars)

        // Définir les catégories pour l'objet Anime
        $anime->setCategories($selectedCategories);

        $contenu = $this->showSuccesfulCreate($anime);
        $anime->setAnimeName(htmlspecialchars($_POST['anime_name']));
        $anime->setAnimeDescription(htmlspecialchars($_POST['anime_description']));
        $anime->setLanguageId($_POST['languageId']);
        if ($_FILES['anime_image']["error"] !== UPLOAD_ERR_NO_FILE) {
            $uploaddir = 'img/anime/';
            $uploadfile = $uploaddir . basename($_FILES['anime_image']['name']);
            move_uploaded_file($_FILES['anime_image']['tmp_name'], $uploadfile);
            $anime->setAnimeImage($_FILES['anime_image']['name']);
        } else {
            $anime->setAnimeImage("default.jpg");
        }
        $this->animeManager->animePush($anime);
        $contenu = $this->showSuccesfulCreate($anime);
    }


    public function getAll()
    {
        // Requête pour récupérer tous les services
        $stmt = $this->connexion->prepare('SELECT * FROM category');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Anime::class);
    }

    public function showSuccesfulCreate(Anime $anime, $message = null)
    {
        return "<h1>Votre animée a été créer avec sucées</h1>";
    }

}
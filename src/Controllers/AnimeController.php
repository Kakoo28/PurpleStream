<?php

namespace PurpleStream\Controllers;

use PurpleStream\Models\Anime;
use PurpleStream\Models\AnimeManager;
use PurpleStream\Controllers\CategoryController;

class AnimeController
{
    private $animeManager;
    
    public function __construct()
    {
        $this->animeManager = new AnimeManager();
    }

    public function showHomePage() {
        if (!isset($_SESSION['user']))
        {
            header('Location: /login');
            exit();
        }
        else if (!isset($_SESSION['selected_profile']))
        {
            header('Location: /profiles');
            exit();
        }

        require VIEWS . 'HomePage.php';
    }

    public function showCreateAnimePage(){
        $categories = $this->animeManager->getAllCategories();
        $languages = $this->animeManager->getAllLanguages();
        require VIEWS . 'FormCreateAnime.php';
    }

    public function createAnime()
    {
        $anime = new Anime();
        $anime->setAnimeName($_POST["anime__name"]);
        $anime->setAnimeDescription($_POST["anime__description"]);
        
        if (isset($_FILES['anime__image']) && $_FILES['anime__image']["error"] !== UPLOAD_ERR_NO_FILE) {
            $uploaddir = 'img/anime/';
            $uploadfile = $uploaddir . basename($_FILES['anime__image']['name']);
            
            if (move_uploaded_file($_FILES['anime__image']['tmp_name'], $uploadfile)) {
                $anime->setAnimeImage($_FILES['anime__image']['name']);
            } else {
                echo "Erreur lors du déplacement du fichier.";
                exit();
            }
        }
        
        $anime->setAnimeLanguageID($_POST["anime__select-language"]);
        $anime->setCategories($_POST["anime__select-categories"]);

        $anime = $this->animeManager->saveAnime($anime);

        $content = $this->showSuccesfulCreate($anime);
        
        require VIEWS . 'Layout.php'; 
    }

    public function showSuccesfulCreate(Anime $anime, $message = null)
    {
        return "<h1>Votre animée a été créer avec succées</h1>";
    }
}
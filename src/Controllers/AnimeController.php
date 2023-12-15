<?php

namespace PurpleStream\Controllers;

use PurpleStream\Models\anime;
use PurpleStream\Models\Season;
use PurpleStream\Models\AnimeManager;

class AnimeController
{
    private $animeManager;
    public function __construct()
    {
        $this->animeManager = new AnimeManager();
    }

    public function showHomePage(){
        require VIEWS . 'HomePage.php';
    }

    public function showCreateAnimePage(){
        $categories = $this->animeManager->getAllCategories();
        $languages = $this->animeManager->getAllLanguages();
        require VIEWS . 'FormCreateAnime.php';
    }

    public function showCreateAnimeSeason()
    {
        require VIEWS . 'FormCreateSeason.php';
    }

    public function createAnime()
    {
        $anime = new Anime();
        $anime->setAnimeName(htmlspecialchars($_POST["anime__name"]));
        $anime->setAnimeDescription(htmlspecialchars($_POST["anime__description"]));
        
        if (isset($_FILES['anime__image']) && $_FILES['anime__image']["error"] !== UPLOAD_ERR_NO_FILE) {
            $uploaddir = 'img/anime';
            $uploadfile = $uploaddir . basename($_FILES['anime__image']['name']);
            
            if (move_uploaded_file($_FILES['anime__image']['tmp_name'], $uploadfile)) {
                $anime->setAnimeImage($_FILES['anime__image']['name']);
            } else {
                echo "Erreur lors du déplacement du fichier.";
            }
        }
        
        $anime->setAnimeLanguageID(htmlspecialchars($_POST["anime__select-language"]));
        $anime->setCategories($_POST["anime__select-categories"]);

        $saveAnime = $this->animeManager->saveAnime($anime);
        $content = $this->showSuccesfulCreate($saveAnime);
        require VIEWS . 'Layout.php'; 
    }

    public function createSeason($id)
    {
        $season = new Season();
        $season->setAnimeId($id);
        $season->setSeasonName(htmlspecialchars($_POST["season__name"]));
        $season->setSeasonDescritpion(htmlspecialchars($_POST["season__desription"]));

        if (isset($_FILES['season__image']) && $_FILES['season__image']["error"] !== UPLOAD_ERR_NO_FILE) {
            $uploaddir = 'img/season';
            $uploadfile = $uploaddir . basename($_FILES['season__image']['name']);
            
            if (move_uploaded_file($_FILES['season__image']['tmp_name'], $uploadfile)) {
                $season->setSeasonImage($_FILES['season__image']['name']);
            } else {
                echo "Erreur lors du déplacement du fichier.";
            }
        }

        $saveSeason = $this->animeManager->saveSeason($season);

        require VIEWS . "Layout.php";
    }

    public function showSuccesfulCreate($saveAnime, $message = null)
    {
        return "
            <div class='div__anime'>
                <h1>Votre animée a été créer avec succées</h1>
                <div class='div__anime-button'>
                <button><a href='create-season?id=" . $saveAnime . "'>crée saison</a></button>
                </div>
            </div>  
            ";
    }
}
<?php

namespace PurpleStream\Controllers;

use PurpleStream\Models\anime;
use PurpleStream\Models\Episode;
use PurpleStream\Models\Season;
use PurpleStream\Models\AnimeManager;

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

    public function showCreateAnimeSeason()
    {
        require VIEWS . 'FormCreateSeason.php';
    }

    public function showCreateEpisode()
    {
        require VIEWS . 'FormCreateEpisode.php';
    }

    public function showAnimeManager()
    {
        require VIEWS . 'AnimeManager.php';
    }

    public function showAnimeSeason()
    {
        $seasons = $this->animeManager->getAllSeasonsAnime($_GET["id"]);
        foreach($seasons as $season)
        {   
            $content = "<div class='div__anime'>
                <h1>Voici les saisons de l'anime</h1>";

            $seasons = $this->animeManager->getAllSeasonsAnime($_GET["id"]);
            foreach($seasons as $season)
            {   
                $content .= "<div class='div__anime-button'>
                    <h2>" . $season->getSeasonName() . "</h2>
                    <button><a href='/anime/show-episode?id=" . $season->getSeasonID() . "'>Voir les épisodes de la saison</a></button>
                    <button><a href='/anime/create-episode?id=" . $season->getSeasonID() . "'>Crée episode</a></button>

                </div>";
            }

            $content .= "</div>";
        }
        $id = $_GET["id"];
        $_SESSION["animeID"] = $id;
        require VIEWS . 'Layout.php';
    }

    public function createAnime()
    {
        $anime = new Anime();
        $anime->setAnimeName(htmlspecialchars($_POST["anime__name"]));
        $anime->setAnimeDescription(htmlspecialchars($_POST["anime__description"]));
        
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
        $content = $this->showSuccesfulCreateSeason($saveSeason);

        require VIEWS . "Layout.php";
    }

    public function createEpisode($idSeason)
    {
        $episode = new Episode();
        $episode->setSeasonId($_GET["id"]);
        $episode->setEpisodeName(htmlspecialchars($_POST["episode__name"]));
        $episode->setEpisodeMP4($_FILES['episode__mp4']['name']);
        $saveEpisode = $this->animeManager->saveEpisode($episode);
        $content = $this->showSuccesfulCreateEpisode($episode);
        require VIEWS . "Layout.php";
    }

    public function searchAnime()
    {
        $animes = $this->animeManager->searchAllAnimes($_POST["searchAnime"]);
        $content = "";
        foreach($animes as $anime)
        {
            $content = $this->showAnime($anime);
        }

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

    public function showSuccesfulCreateEpisode(Episode $episode, $message = null)
    {
        return "
            <div class='div__episode'>
                <h1>Votre épisode a été créer avec succées</h1>
                <div class='div__episode-button'>
                    <h2>" . $episode->getEpisodeName() . "</h2>
                    <button><a href='/anime/show-season?id=" . $_SESSION["animeID"] . "'>Voir les saisons de l'anime</a></button>
                </div>
            </div>
        ";
    }

    public function showAnime(Anime $anime, $message = null)
    {
        return "
            <div class='div__anime'>
                <h1>Voici les animes</h1>
                <div class='div__anime-button'>
                    <h2>" . $anime->getAnimeName() . "</h2>
                    <p>" . $anime->GetAnimeDescription() . "</p>
                    <button><a href='/anime/show-season?id=" . $anime->getAnimeID() . "'>Voir les saisons de l'anime</a></button>
                    <button><a href='/anime/create-season?id=" . $anime->getAnimeID() . "'>Crée une saison</a></button>
                </div>
            </div>  
            ";
    }

    public function showSuccesfulCreateSeason($saveSeason, $message = null)
    {
        return "
            <div class='div__anime'>
                <h1>Votre saison a été créer avec succées</h1>
                <div class='div__anime-button'>
                <button><a href='create-episode?id=" . $saveSeason . "'>crée épisode</a></button>
                </div>
            </div>  
            ";
    }
}
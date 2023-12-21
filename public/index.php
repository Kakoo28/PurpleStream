<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';

$router = new PurpleStream\Router($_SERVER['REQUEST_URI']);

$router->get('/', 'LandingController@index');

$router->get('/login?:status', 'UserController@showLoginForm');
$router->get('/register?:error', 'UserController@showRegisterForm');

$router->post('/process-login', 'UserController@login');
$router->post('/process-register', 'UserController@create');

$router->get('/anime/create', 'AnimeController@showCreateAnimePage');
$router->get('/anime/create-season/?:id', 'AnimeController@showCreateAnimeSeason');
$router->get('/anime/create-episode/?:id', 'AnimeController@showCreateEpisode');
$router->get('/admin/animemanager', 'AnimeController@showAnimeManager');
$router->get('/anime/show-season/?:id', 'AnimeController@showAnimeSeason');
$router->get('/anime/show-episode/?:id', 'AnimeController@showAnimeEpisode');
$router->post('/anime/process-create', 'AnimeController@createAnime');
$router->post('/anime/process-create-season/?:id', 'AnimeController@createSeason');
$router->post('/anime/process-create-episode/?:id', 'AnimeController@createEpisode');
$router->post('/admin/allAnimes', 'AnimeController@searchAnime');

$router->get('/home', 'AnimeController@showHomePage');

$router->run();
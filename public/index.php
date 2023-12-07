<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';

$router = new PurpleStream\Router($_SERVER['REQUEST_URI']);

$router->get('/', 'HomeController@index');
$router->get('/login', 'UserController@showLogin');

$router->get('/anime/create', 'AnimeController@showcreateAnime');
$router->post('/anime/create/finish', 'AnimeController@createAnime');

$router->run();
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
$router->post('/anime/process-create', 'AnimeController@createAnime');

$router->get('/home', 'AnimeController@showHomePage');

$router->run();
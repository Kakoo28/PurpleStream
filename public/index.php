<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';

$router = new PurpleStream\Router($_SERVER['REQUEST_URI']);

$router->get('/', 'HomeController@index');

$router->run();
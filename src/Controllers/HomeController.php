<?php

namespace PurpleStream\Controllers;

class HomeController {
    public function __construct() 
    {

    }

    public function index() {
        require VIEWS . 'Home.php';
    }

}
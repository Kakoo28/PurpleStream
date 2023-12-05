<?php 

namespace PurpleStream\Controllers;

class UserController {
    public function __construct() 
    {

    }

    public function showLogin() {
        require VIEWS . 'Login.php';
    }
}
<?php 

namespace PurpleStream\Controllers;

use PurpleStream\Models\UserManager;
use PurpleStream\Models\UserModel;

class UserController 
{
    private $userManager;

    public function __construct() 
    {
        $this->userManager = new UserManager();
    }

    public function create()
    {
        // error 1 : password and confirm password are not the same
        // error 2 : email already exists

        // vérification du mot de passe de confirmation
        if ($_POST['user_password'] != $_POST['user_confirm_password']) 
        {
            header('Location: /register?error=1');
            exit();
        }

        // vérification de l'email
        $email = strtolower(htmlspecialchars($_POST['user_email']));
        $emailAlreadyUsed = $this->userManager->getUserByEmail($email);

        if ($emailAlreadyUsed)
        {
            return header('Location: /register?error=2');
            exit();
        }

        $user = new UserModel();

        $hashed_password = password_hash($_POST['user_password'], PASSWORD_BCRYPT);

        $user->setUserName(htmlspecialchars($_POST['user_name']));
        $user->setUserEmail($email);
        $user->setUserPassword($hashed_password);

        $this->userManager->create($user);

        header('Location: /login?status=200');
    }

    public function login()
    {
        $email = strtolower(htmlspecialchars($_POST['user_email']));
        echo $email;
    }

    public function showLoginForm() 
    {
        require VIEWS . 'FormLogin.php';
    }

    public function showRegisterForm()
    {
        require VIEWS . 'FormRegister.php';
    }
}
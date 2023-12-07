<?php 

namespace PurpleStream\Models;

class UserManager
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = new \PDO('mysql:host=' . DB_CONFIG['HOST'] . ';dbname='. DB_CONFIG['DATABASE'] .';charset=utf8', DB_CONFIG['USER'], DB_CONFIG['PASSWORD']);
    }

    public function create(UserModel $user)
    {
        $stmt = $this->connexion->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :user_email, :user_password)");
        $stmt->execute([
            'user_name' => $user->getUserName(),
            'user_email' => $user->getUserEmail(),
            'user_password' => $user->getUserPassword()
        ]);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM users WHERE user_email = :user_email");
        $stmt->execute([
            'user_email' => $email
        ]);
        $result = $stmt->fetch();
        return $result;
    }
}
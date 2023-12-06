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
        $stmt = $this->connexion->prepare("INSERT INTO users (userName, userEmail, userPassword) VALUES (:userName, :userEmail, :userPassword)");
        $stmt->execute([
            'userName' => $user->getUserName(),
            'userEmail' => $user->getUserEmail(),
            'userPassword' => $user->getUserPassword()
        ]);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM users WHERE userEmail = :email");
        $stmt->execute([
            'email' => $email
        ]);
        $result = $stmt->fetch();
        return $result;
    }
}
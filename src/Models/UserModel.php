<?php 

namespace PurpleStream\Models;

class UserModel
{
    private $userID;
    private $userEmail;
    private $userName;
    private $userPassword;
    private $userRole;
    
    public function __construct()
    {

    }

    public function setAll($userID, $userEmail, $userName, $userPassword, $userRole)
    {
        $this->userID = $userID;
        $this->userEmail = $userEmail;
        $this->userName = $userName;
        $this->userPassword = $userPassword;
        $this->userRole = $userRole;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    public function getUserEmail()
    {
        return $this->userEmail;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
    }

    public function getUserPassword()
    {
        return $this->userPassword;
    }

    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;
    }

    public function getUserRole()
    {
        return $this->userRole;
    }
}
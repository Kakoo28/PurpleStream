<?php 

namespace PurpleStream\Models;

class UserModel
{
    private $user_id;
    private $user_email;
    private $user_name;
    private $user_password;
    private $user_role;
    
    public function __construct()
    {

    }

    public function setAll($user_id, $user_email, $user_name, $user_password, $user_role)
    {
        $this->user_id = $user_id;
        $this->user_email = $user_email;
        $this->user_name = $user_name;
        $this->user_password = $user_password;
        $this->user_role = $user_role;
    }

    public function setuser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getuser_id()
    {
        return $this->user_id;
    }

    public function setuser_email($user_email)
    {
        $this->user_email = $user_email;
    }

    public function getuser_email()
    {
        return $this->user_email;
    }

    public function setuser_name($user_name)
    {
        $this->user_name = $user_name;
    }

    public function getuser_name()
    {
        return $this->user_name;
    }

    public function setuser_password($user_password)
    {
        $this->user_password = $user_password;
    }

    public function getuser_password()
    {
        return $this->user_password;
    }

    public function setuser_role($user_role)
    {
        $this->user_role = $user_role;
    }

    public function getuser_role()
    {
        return $this->user_role;
    }
}
<?php

class Admin {
    
    private $id;
    private $login;
    private $password;
    
    public function __construct() {
        $this->id = -1;
        $this->login = '';
        $this->password = '';
    }
    
    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashedPassword;
    }
    
}
<?php

class User {
    private $id;
    private $name;
    private $surname;
    private $mail;
    private $password;
    private $address;
    
    public function __construct() {
        $this->id = -1;
        $this->name = '';
        $this->surname = '';
        $this->mail = '';
        $this->password = '';
        $this->address = '';
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getMail() {
        return $this->mail;
    }

    function getPassword() {
        return $this->password;
    }

    function getAddress() {
        return $this->address;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setPassword($password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashedPassword;
    }

    function setAddress($address) {
        $this->address = $address;
    }


}
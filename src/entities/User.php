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

    public function saveUser(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO User(name, surname, mail, password, address)
            VALUES('{$this->name}', '{$this->surname}', '{$this->mail}'), "
                    . "'{$this->password}', '{$this->address}')";

            $result = $connection->query($sql);

            if ($result === TRUE) {
                $this->id = $connection->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE User SET mail='{$this->mail}',
            address='{$this->address}', password='{$this->password}'
            WHERE id={$this->id}";

            $result = $connection->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    public function deleteUser(mysqli $connection, $user_id) {
        if ($user_id != -1) {
            $sql = "DELETE FROM User WHERE id=$user_id";
            $result = $connection->query($sql);
            
            if ($result == true) {
                return True;
            }
            return False;
        }
        return True;
    }

}

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
    
    public function saveNewAdmin(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Admin(login, password)
            VALUES('{$this->login}', '{$this->password}')";

            $result = $connection->query($sql);

            if ($result === TRUE) {
                $this->id = $connection->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Admin SET login='{$this->login}',
            password='{$this->password}' WHERE id={$this->id}";

            $result = $connection->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }
    
    public static function loadAdminByLogin(mysqli $connection, $login) {
        
        $sql = "SELECT * FROM Admin WHERE login=$login";
        $result = $connection->query($sql);
        
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedAdmin = new Admin();
            $loadedAdmin->id = $row['id'];
            $loadedAdmin->login = $row['login'];
            $loadedAdmin->password = $row['password'];
            return $loadedAdmin;
        }
        return null;
                
    }
    
}
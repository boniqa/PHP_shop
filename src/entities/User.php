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

    static public function returnAllUsers(mysqli $connection) {
        $sql = "SELECT * FROM Users ORDER BY id DESC";

        $return = [];

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $user = new User();
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->surname = $row['surname'];
                $user->mail = $row['mail'];
                $user->password = $row['password'];
                $user->address = $row['address'];

                $return[] = $user;
            }
        }
        return $return;
    }

    public function returnUserById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Users WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->name = $row['name'];
            $loadedUser->surname = $row['surname'];
            $loadedUser->mail = $row['mail'];
            $loadedUser->password = $row['password'];
            $loadedUser->address = $row['address'];
            return $loadedUser;
        }
        return null;
    }

    static public function printAllUsers(mysqli $connection) {
        $loadUsers = User::returnAllUsers($connection);

        echo "<div class='container'><table class='table table-hover'>";
        echo "<thead><tr><th class='col-md-1'>ID</th><th class='col-md-2'>Name</th>"
        . "<th class='col-md-2'>Surname</th><th class='col-md-2'>Mail</th>"
        . "<th class='col-md-4'>Address</th><th class='col-md-1'>Edit</th></tr></thead><tbody>";


        foreach ($loadUsers as $user) {
            echo "<tr>";
            echo "<td>".$user->getId()."</td>";
            echo "<td>".$user->getName()."</td>";
            echo "<td>".$user->getSurname()."</td>";
            echo "<td>".$user->getMail()."</td>";
            echo "<td>".$user->getAddress()."</td>";
            echo "<td><a href='adminEditUser.php?userId='" . $user->getId() . "><button type='submit' class='btn btn-primary'>Edit user</button></td>";
            echo "</tr>";
        }
        
        echo "</tbody></table></div>";
    }

}

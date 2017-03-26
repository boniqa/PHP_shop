<?php

class Categories {

    private $id;
    private $name;

    public function __construct() {
        $this->id = -1;
        $this->name = '';
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }


    public function saveNewCategory(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Categories(name)
            VALUES('{$this->name}')";

            $result = $connection->query($sql);
            
            if ($result === TRUE) {
                $this->id = $connection->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Categories SET name='{$this->name}' WHERE id={$this->id}";

            $result = $connection->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    public function deleteCategory(mysqli $connection, $category_id) {
        if ($category_id > 0) {
            $sql = "DELETE FROM Categories WHERE id=$category_id";
            $result = $connection->query($sql);
            
            if ($result == true) {
                return True;
            }
            return False;
        }
        return True;
    }
}

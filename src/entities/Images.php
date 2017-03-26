<?php

class Images {

    private $id;
    private $directory;
    private $product_id;

    public function __construct() {
        $this->id = -1;
        $this->directory = '';
        $this->product_id = -1;
    }

    function getId() {
        return $this->id;
    }

    function getDirectory() {
        return $this->directory;
    }

    function getProduct_id() {
        return $this->product_id;
    }

    function setDirectory($directory) {
        $this->directory = $directory;
    }

    function setProduct_id($product_id) {
        $this->product_id = $product_id;
    }

    public function saveNewImage(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Images(directory, product_id)
            VALUES('{$this->directory}', '{$this->product_id}')";

            $result = $connection->query($sql);

            if ($result === TRUE) {
                $this->id = $connection->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Images SET directory='{$this->directory}',
            product_id='{$this->product_id}' WHERE id={$this->id}";
            
            $result = $connection->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

    public function deleteImage(mysqli $connection, $image_id) {
        if ($image_id > 0) {
            $sql = "DELETE FROM Images WHERE id=$image_id";
            $result = $connection->query($sql);
            
            if ($result == true) {
                return True;
            }
            return False;
        }
        return True;
    }
    
}

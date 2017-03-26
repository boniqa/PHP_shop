<?php

class Product {

    private $id;
    private $name;
    private $description;
    private $quantity;
    private $price;
    private $category_id;

    public function __construct() {
        $this->id = -1;
        $this->name = '';
        $this->description = '';
        $this->quantity = 0;
        $this->price = 0;
        $this->category_id = '';
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getPrice() {
        return $this->price;
    }

    function getCategory_id() {
        return $this->category_id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }

    public function saveNewProduct(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Product(name, description, quantity, price, category_id)
            VALUES('{$this->name}', '{$this->description}', '{$this->quantity}', "
            . "'{$this->price}' , '{$this->category_id}')";

            $result = $connection->query($sql);

            if ($result === TRUE) {
                $this->id = $connection->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Product SET name='{$this->name}',
            description='{$this->description}', '{$this->quantity}', "
            . "'{$this->price}', '{$this->category_id}' WHERE id={$this->id}";

            $result = $connection->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }
    
    public function returnAllProductsByCategory(mysqli $connection, $category_id) {
        $sql = "SELECT * FROM Product JOIN Categories "
                . "ON Product.category_id=Categories.id WHERE Categories.id = $category_id";

        $return = [];

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $product = new Product();
                $product->id = $row['id'];
                $product->name = $row['name'];
                $product->description = $row['description'];
                $product->quantity = $row['quantity'];
                $product->price = $row['price'];
                $product->category_id = $row['category_id'];

                $return[] = $product;
            }
        }
        return $return;
    }

    public function deleteProduct(mysqli $connection, $product_id) {
        if ($product_id > 0) {
            $sql = "DELETE FROM Product WHERE id=$product_id";
            $result = $connection->query($sql);
            
            if ($result == true) {
                return True;
            }
            return False;
        }
        return True;
    }
}

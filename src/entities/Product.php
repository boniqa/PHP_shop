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


}

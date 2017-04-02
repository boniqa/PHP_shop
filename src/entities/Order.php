<?php

class Order {

    private $id;
    private $product_id;
    private $user_id;
    private $amount;

    function getId() {
        return $this->id;
    }

    function getProduct_id() {
        return $this->product_id;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getAmount() {
        return $this->amount;
    }

    function setProduct_id($product_id) {
        $this->product_id = $product_id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }

    public function saveNewOrder(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Order(products, user_id, amount)
            VALUES('{$this->products}', '{$this->user_id}', '{$this->amount}')";

            $result = $connection->query($sql);

            if ($result === TRUE) {
                $this->id = $connection->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Order SET products='{$this->products}',
            user_id='{$this->user_id}', amount='{$this->amount}' WHERE id={$this->id}";

            $result = $connection->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }

}

<?php

class Order {

    private $id;
    private $product_id;
    private $user_id;
    private $amount;
    private $status_id;


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
    
    function getStatus_id() {
        return $this->status_id;
    }

    function setStatus_id($status_id) {
        $this->status_id = $status_id;
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
    
    public function returnAllOrdersByUserId(mysqli $connection, $user_id) {
        $sql = "SELECT * FROM Order WHERE user_id = $user_id ORDER BY status_id DESC";
        
        $return = [];
        
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $orders = new Order(); 
                $orders->id = $row['id'];
                $orders->product_id = $row['product_id'];
                $orders->amount = $row['amount'];
                $orders->status_id = $row['status_id'];

                $return[] = $orders;
            }
        }
        return $return;
    }

}


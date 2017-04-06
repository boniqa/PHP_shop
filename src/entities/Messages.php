<?php

class Messages {

    private $id;
    private $user_id;
    private $message;
    private $order_id;

    public function __construct() {
        $this->id = -1;
        $this->message = '';
        $this->user_id = 0;
        $this->order_id = 0;
    }

    function getId() {
        return $this->id;
    }

    function getMessage() {
        return $this->message;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function getOrder_id() {
        return $this->order_id;
    }

    function setOrder_id($order_id) {
        $this->order_id = $order_id;
    }
    
    public function saveMessage(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Messages(user_id, text, order_id)
          VALUES('{$this->user_id}', '{$this->message}', '{$this->order_id}');";

            $result = $connection->query($sql);

            if ($result === TRUE) {
                $this->id = $connection->insert_id;
                return True;
            } else {
                return False;
            }
        } else {
            $sql = "UPDATE Messages SET user_id='{$this->user_id}',
          text='{$this->text}', order_id='{$this->order_id}'
          WHERE id={$this->id}";

            $result = $connection->query($sql);
            if ($result == true) {
                return True;
            }
        }
        return False;
    }
    
    public function returnAllMessages(mysqli $connection) {
        $sql = "SELECT * FROM Messages ORDER BY id DESC";
        
        $return = [];
        
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $message = new Messages(); //Chyba literówka była?
                $message->id = $row['id'];
                $message->user_id = $row['user_id'];
                $message->message = $row['text'];
                $message->order_id = $row['order_id'];

                $return[] = $message;
            }
        }
        return $return;
    }

    public function returnAllUserIdMsgs(mysqli $connection, $user_id) {
        $sql = "SELECT * FROM Messages WHERE user_id = $user_id ORDER BY id DESC";
        
        $return = [];
        
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $message = new Messages(); // Poprawiłam Message na M-s bo tworzysz nowy obiekt klasy, tak? Chyba literówka
                $message->id = $row['id'];
                $message->message = $row['text'];
                $message->order_id = $row['order_id'];

                $return[] = $message;
            }
        }
        return $return;
    }
    
}

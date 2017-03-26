<?php

class Messages {
    private $id;
    private $message;
    private $user_id;
    
    public function __construct() {
        $this->id = -1;
        $this->message = '';
        $this->user_id = '';
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

}
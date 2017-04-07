<?php

session_start();
require_once 'adminHeader.php';
require_once '../src/entities/connection.php';
require_once '../src/entities/includeEntities.php';


//Nie printuje userow
$userList = User::printAllUsers($conn);

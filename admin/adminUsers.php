<?php

session_start();
require_once 'adminHeader.php';
require_once '../src/entities/connection.php';
require_once '../src/entities/includeEntities.php';

/*
echo "<div class='container'><table class='table table-hover'>";
echo "<thead><tr><th class='col-md-1'>ID</th><th class='col-md-2'>Name</th>"
. "<th class='col-md-2'>Surname</th><th class='col-md-2'>Mail</th>"
        . "<th class='col-md-4'>Address</th><th class='col-md-1'>Edit</th></tr></thead><tbody>";
*/
$userList = User::printAllUsers($conn);

//echo "</tbody></table></div>";
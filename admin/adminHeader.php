<?php 
require_once '../src/entities/connection.php';
require_once '../src/entities/includeEntities.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Twitter-clone by Michał Oleszczuk</title>
        <meta charset="UTF-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">Admin panel</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="adminUsers.php" id="user-btn">Manage users</a></li>
                    <li><a href="adminProducts.php" id="products-btn">Add/edit products</a></li>
                    <li><a href="adminCategories.php" id="categories-btn">Add/edit categories</a></li>
                    <li><a href="adminOrders.php" id="orders-btn">Manage orders</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="adminLogout.php"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
                </ul>
            </div>
        </nav>
    </body>
</html>

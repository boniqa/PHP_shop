<?php
session_start();
require_once '../src/entities/connection.php';
require_once '../src/entities/includeEntities.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shop thingamajig</title>
        <meta charset="UTF-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="container-fluid">
                <h2>Admin panel</h2><hr>
                <div class="container-fluid form-group">
                    <form class ="row" method="POST" action="#">
                        <div>
                            <input type="text" name="admin" placeholder="login" class="btn-block"><br>
                            <input type="password" name="password" placeholder="password" class="btn-block"><br>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">
                                <span class=""></span>&nbsp;&nbsp;Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['admin']);
    $password = trim($_POST['password']);
    
    $sql = "SELECT * FROM Admin WHERE login = '$login';";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_login'] = $row['login'];
            echo "Hi again {$row['login']}";

            header("Location: adminUsers.php");
        } else {
            echo "<div class='col-md-12 text-center'><h1>Niepoprawne dane</h1></div>";
        }
    }
}
?>
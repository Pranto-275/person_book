<?php
global $connection;
include 'database/connection.php';
session_start();

$user_name = $_SESSION['user_name'];
$user_image = $_SESSION['user_image'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="img/url_logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="friend_list p-5">
            <div class="col-12">
                <h3> Make New Friends!!!</h3>
            </div>
        </div>
    </div>
    <div class="row"  id="peoples_list">

    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
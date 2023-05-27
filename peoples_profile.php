<?php
global $connection;
include 'database/connection.php';
session_start();

$user_name = $_SESSION['user_name'];
$user_image = $_SESSION['user_image'];
$user_id = $_SESSION['user_id'];


$get_people_id = $_GET['id'];


$get_people_info_query = "SELECT * FROM users WHERE user_id = '$get_people_id'";
$get_people_info_query_result = mysqli_query($connection,$get_people_info_query);

$data = mysqli_fetch_assoc($get_people_info_query_result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="img/url_logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body style="background: #D9AFD9">
<?php include 'navbar.php'; ?>

<div class="container" id="peoples_profile">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="cover_image" style=" background: url('<?php echo $data['cover_image']; ?>');  background-position: center; background-repeat: no-repeat;
                        background-size: cover;"></div>
                <div class="card-body text-center" style="margin-top: -80px;">
                    <?php
                    if ($data['profile_image'] == '') { ?>
                        <div class="profile_image "><img src="img/default.jpg" alt="Upload your Pic" style="width:100px; height: auto;" class=""></div>
                    <?php } else { ?>

                        <div class="profile_image "><img src="<?php echo $data['profile_image']; ?>"
                                                         alt="Upload your Pic" style="width:100px; height: auto;"
                                                         class=""></div>
                        <?php

                    }

                    ?>

                    <div style="margin-top: 15px;" style="color: gray;">
                        <h5><?php echo $data['user_name'] ?></h5>
                    </div>
                    <div class="row" style="font-size: 13px;">
                        <div class="col-4">
                            Following : 5884
                        </div>
                        <div class="col-4">
                            joined <?php echo $data['join_date'] ?>


                        </div>
                        <div class="col-4" id="icon_design" style="font-size: 15px;">
                            <!--                            <span style="padding: 10px;"><a href=""><i-->
                            <!--                                        class="fa-brands fa-facebook fa-lg"></i></a></span>-->
                            <!--                                <span style="padding: 10px;"><a href=""><i-->
                            <!--                                            class="fa-brands fa-instagram  fa-lg"></i></a></span>-->
                            <!--                                <span style="padding: 10px;"><a href=""><i-->
                            <!--                                            class="fa-brands fa-youtube  fa-lg"></i></a></span>-->

                            <button class="btn btn-info">Add Friend</button>
                        </div>
                    </div>







                </div>
            </div>
        </div>
    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>

</html>

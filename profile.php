<?php
global $connection;
include 'database/connection.php';
session_start();

$user_name = $_SESSION['user_name'];
$user_image = $_SESSION['user_image'];
$user_id = $_SESSION['user_id'];


$get_profile_info_query = "SELECT * FROM users WHERE user_id = '$user_id'";
$get_profile_info_result = mysqli_query($connection, $get_profile_info_query);
$row = mysqli_fetch_assoc($get_profile_info_result);


$get_all_image_query = "SELECT image FROM posts  WHERE user_id = '$user_id' ";
$get_all_image_query_result = mysqli_query($connection,$get_all_image_query);


$user_image_query = "SELECT profile_image,cover_image FROM users  WHERE user_id = '$user_id' ";
$user_image_query_result = mysqli_query($connection,$user_image_query);





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

<body>
<?php include 'navbar.php'; ?>

<div class="container" id="profile_user_info">
    <div class="row p-2">
        <div class="col-9">
            <div class="card">
                <div class="cover_image"
                     style=" background: url('<?php echo $row['cover_image']; ?>');  background-position: center; background-repeat: no-repeat;
                         background-size: cover;"></div>
                <div class="card-body text-center" style="margin-top: -80px;">

                    <?php
                    if ($row['profile_image'] == '') { ?>
                        <div class="profile_image "><img src="img/default.jpg" alt="Upload your Pic"
                                                         style="width:100px; height: auto;"
                                                         class=""></div>
                    <?php } else { ?>

                        <div class="profile_image "><img src="<?php echo $row['profile_image']; ?>"
                                                         alt="Upload your Pic" style="width:100px; height: auto;"
                                                         class=""></div>
                        <?php

                    }

                    ?>


                    <div style="margin-top: 15px;" style="color: gray;">
                        <h5><?php echo $row['user_name']; ?></h5>
                    </div>
                    <div class="row" style="font-size: 13px;">
                        <div class="col-4">
                            Following : 5884
                        </div>
                        <div class="col-4">
                            joined <?php echo $row['join_date'];?>
                        </div>
                        <div class="col-4" id="icon_design" style="font-size: 15px;">
                            <span style="padding: 10px;"><a href=""><i
                                        class="fa-brands fa-facebook fa-lg"></i></a></span>
                            <span style="padding: 10px;"><a href=""><i
                                        class="fa-brands fa-instagram  fa-lg"></i></a></span>
                            <span style="padding: 10px;"><a href=""><i
                                        class="fa-brands fa-youtube  fa-lg"></i></a></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="py-5" id="nav_tab">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home">TimeLine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#menu1">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#menu2">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#menu3">Friends</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <!-- timeline start======================================================= -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                        <h3>Timeline</h3>

                        <div>
                        <!-- ============================================Button trigger modal ====================-->
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div><img src="<?php echo $user_image; ?>" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                                        </div>
                                        <div style="padding: 20px;color: gray;">
                                            Post Something!!!
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <span class="p-1">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </span>
                                    <span class="p-1">
                                        <i class="fa-solid fa-camera"></i>
                                    </span>

                                </div>
                            </div>
                        </a>


                    </div>

                        <input type="hidden" value="<?php echo $user_name; ?>" id="username">
                        <input type="hidden" value="<?php echo $user_image; ?>" id="user_image">
                        <!-- ==============================================post section -->
                        <div id="p_status_post">

                        <input type="hidden" id="counter">
                    </div>


                    </div>


                    <!-- ==================================profile edit start================================= -->
                    <div id="menu1" class="container tab-pane fade"><br>
                        <div>

                            <div class="card p-3" style="background-color: white;">
                                <div class="card-body">

                                        <div class="mb-3">
                                            <label class="form-label">Change Profile Image</label>
                                            <input type="file" class="form-control" id="profile_image">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Change Cover Image</label>
                                            <input type="file" class="form-control"  id="cover_image">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Change Your Name</label>
                                            <input type="text" class="form-control"  id="profile_name">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Change Your Email</label>
                                            <input type="email" class="form-control"  id="user_email">
                                        </div>

                                        <button type="submit" class="btn btn-primary" id="profile_submit">Submit</button>


                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- ==================================profile edit End================================= -->

                    <div id="menu2" class="container tab-pane fade"><br>

                        <h3>Images</h3>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php


                                    $row = mysqli_fetch_assoc($user_image_query_result);

                                    ?>
                                    <div class="col-4">
                                        <img src="<?php echo $row['profile_image']; ?>" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-4">
                                        <img src="<?php echo $row['cover_image']; ?>" alt="" class="img-thumbnail">
                                    </div>



                                    <?php

                                        while ($row = mysqli_fetch_assoc($get_all_image_query_result)){
                                            ?>
                                            <div class="col-4">
                                                <img src="<?php echo $row['image']; ?>" alt="" class="img-thumbnail">
                                            </div>


                                    <?php
                                        }

                                        ?>

                                </div>
                            </div>
                        </div>


                    </div>
                    <div id="menu3" class="container tab-pane fade"><br>
                        <h3>Friends</h3>
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Serial</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;"
                                                 class="rounded-pill"></td>
                                        <td>Alex</td>
                                        <td>
                                            <span> <button class="btn btn-danger">Unfollow</button> </span>
                                            <span> <button class="btn btn-info">View Profile</button> </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>1</th>
                                        <td><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;"
                                                 class="rounded-pill"></td>
                                        <td>Alex</td>
                                        <td>
                                            <span> <button class="btn btn-danger">Unfollow</button> </span>
                                            <span> <button class="btn btn-info">View Profile</button> </span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>1</th>
                                        <td><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;"
                                                 class="rounded-pill"></td>
                                        <td>Alex</td>
                                        <td>
                                            <span> <button class="btn btn-danger">Unfollow</button> </span>
                                            <span> <button class="btn btn-info">View Profile</button> </span>
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <div class="col-3">
            <div class="left_bar">
                <div class="card" style="margin-top: 30px;">
                    <div class="card-header">
                        Friend
                    </div>
                    <div class="card-body">
                        <p>Last update Image 2 days ago</p>
                        <p>Last update profile 1 days ago</p>
                        <p>Last update 1 days ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- status Modal start-->

    <!-- status Modal start-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create A Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- post section -->
                <div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <div><img src="<?php echo $user_image; ?>" alt="Avatar Logo" style="width:40px;" class="rounded-pill"></div>
                            <div style="padding: 20px">
                                <?php echo $user_name; ?>
                            </div>
                        </div>
                        <div class="form-floating " style="color:gray">
                            <textarea class="form-control" placeholder="Leave a comment here" style="height: 100px" id="status"></textarea>
                            <label for="floatingTextarea2">Write Here What's On Your Mind!!!!!!!</label>
                        </div>
                        <div class="my-3">
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="posts">Post</button>
                    </div>
                </div>

                <!-- post section -->
            </div>
        </div>
    </div>
    <!-- status Modal End-->

<!-- status Modal End-->


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>

</html>
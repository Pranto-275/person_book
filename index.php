<?php
global $connection;
include 'database/connection.php';
session_start();

$user_name = $_SESSION['user_name'];
$user_image = $_SESSION['user_image'];

//
//$show_all_friends = "SELECT user_name,profile_image FROM users ORDER BY ID DESC ";
//$show_all_friends_result = mysqli_query($connection,$show_all_friends);
//



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
    <section>
        <div id="off_canvas">

            <div class="offcanvas offcanvas-start" id="demo">
                <div class="card" style="margin-top: 30px;">
                    <div>
                        Suggestions
                    </div>
                    <div class="card-body" >
                        <div class="d-flex justify-content-evenly align-items-center">
                            <div><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                            </div>
                            <div style="padding:20px">
                                Alex begas
                            </div>
                            <div style="padding:20px">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                        </div>

                        <div class="d-flex justify-content-evenly">
                            <div><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                            </div>
                            <div style="padding:20px">
                                Alex begas
                            </div>
                            <div style="padding:20px">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                        </div>

                        <div class="d-flex justify-content-evenly">
                            <div><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                            </div>
                            <div style="padding:20px">
                                Alex begas
                            </div>
                            <div style="padding:20px">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                        </div>

                        <div class="d-flex justify-content-evenly">
                            <div><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                            </div>
                            <div style="padding:20px">
                                Alex begas
                            </div>
                            <div style="padding:20px">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                        </div>

                        <div class="d-flex justify-content-evenly">
                            <div><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                            </div>
                            <div style="padding:20px">
                                Alex begas
                            </div>
                            <div style="padding:20px">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                        </div>

                        <a href="add_friend_list.php" class=" float-end">See More</a>

                    </div>
                </div>
            </div>


            <button class="btn btn-info float-start" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                Suggestions
            </button>


        </div>
        <div id="off_canvas_right">

            <div class="offcanvas offcanvas-start" id="demo2">
                <div class="card" style="margin-top: 30px;">
                    <div>
                        Friend
                    </div>
                    <div class="card-body">
<!--                        <div id="connected_friends"></div>-->
                        <div class="d-flex justify-content-evenly align-items-center">
                            <div><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                            </div>
                            <div style="padding:20px">
                                Alex begas
                            </div>
                            <div style="padding:20px">
                                <a href="#" class="btn btn-info"> <i class="fa-solid fa-user"></i></a>
                            </div>
                        </div>




                        <a href="friend_list.html" class="float-end">See More</a>
                    </div>
                </div>
            </div>


            <button class="btn btn-danger float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo2">
                friends
            </button>


        </div>


    </section>
    <section>
        <div class="container" id="main_body">
            <div class="row">
                <div class="col-lg-3  col-md-4 left_bar">


                    <div class="left_bar">
                        <div class="left_bar_section">


                            <div class="card" style="margin-top: 30px;">
                                <div class="card-header">
                                    Suggestions
                                </div>
                                <div class="card-body">
                                    <div id="suggestion_friends"></div>
                                    <a href="add_friend_list.php" class=" float-end">See More</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-8 col-sm-12">
                    <div class="p-3">
                        <h2>Timeline</h2>
                    </div>
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


                    <!-- ==============================================post section -->


                    <input type="hidden" value="<?php echo $user_name; ?>" id="username">
                    <input type="hidden" value="<?php echo $user_image; ?>" id="user_image">
                    <input type="hidden" id="counter">

                    <div id="status_post">

                    </div>


                    <!-- ==============================================post section end-->

                </div>

                <!-- ===============================================Friends list end =============================================================== -->

                <div class="col-lg-3 left_bar">
                    <div class="left_bar">
                        <div class="right_bar_section">
                            <div class="card" style="margin-top: 30px;">
                                <div class="card-header">
                                    Friend
                                </div>
                                <div class="card-body">
                                    <div id="connected_friends"></div>
                                    <a href="friend_list.html.html" class=" float-end">See More</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===============================================Friends list end =============================================================== -->

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


    <!-- Comments Modal start-->
    <div class="modal fade" id="commentsmodal" tabindex="-1" aria-labelledby="commentsmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="commentsmodal">Comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    <div class="modal-body">
                        <div class="d-flex">
                            <div><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                            </div>
                            <div style="padding: 20px">
                                Alex
                            </div>
                        </div>
                        <div class="form-floating " style="color:gray">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Leave A Comment</label>
                        </div>
                        <div class="my-3">
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- status Modal End-->


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
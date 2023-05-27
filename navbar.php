<?php
global $connection;
include 'database/connection.php';
$message = '';
if (!$_SESSION['user_name']){
    header('Location:login.php');
}

$user_name = $_SESSION['user_name'];
$user_image = $_SESSION['user_image'];




?>

<header style="margin-bottom: 70px">
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Person Book</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <div class="d-flex ustify-content-evenly align-items-center">
                    <div style="padding-right: 20px;" ><i class="fa-solid fa-message fa-lg me-2"></i></div>
                    <div style="padding-right: 20px;">

                        <a type="button"  data-bs-toggle="modal" data-bs-target="#notificationmodal">
                            <i class="fa-sharp fa-solid fa-bell fa-lg me-2"   id="notification"></i>
                        </a>
                     </div>
                    <div style="padding-left: 20px;">

                        <a class="navbar-brand" href="profile.php">
                            <span><?php echo  $user_name;?></span>
                            <img src="<?php echo $user_image; ?>" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                        </a>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                        </span>
                    </div>
                </div>
            </div>
    </nav>
</header>



<div class="modal fade" id="notificationmodal" tabindex="-1" aria-labelledby="notificationmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="notificationmodal">Notification</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>

                        <th>Peoples</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody id="friend_request_list">


                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
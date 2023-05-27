<?php
global $connection;
include 'database/connection.php';
session_start();
$message = '';



if ($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['login'])){
        $login_email = $_POST['login_email'];
        $login_password = $_POST['login_password'];
        if (empty($login_email) || empty($login_password)){
            $message = "Please Fill-up All Field!!";
        }else{
            if (!filter_var($login_email, FILTER_VALIDATE_EMAIL)) {
                $message = "Invalid email";
            }
            else{
                $login_sql = "SELECT * FROM users WHERE email= '$login_email'";
                $login_result = mysqli_query($connection,$login_sql);
                $userdata = mysqli_fetch_assoc($login_result);
                $hashpass = $userdata['password'];

                if ($login_result && password_verify($login_password,$hashpass)){

                    if($login_email == $userdata['email']){
                       $_SESSION['user_name'] = $userdata['user_name'];
                       $_SESSION['user_image'] = $userdata['profile_image'];
                        $_SESSION['user_id'] = $userdata['user_id'];
                       header('Location:index.php');
                    }else{
                        $message = "Email Mismatch!";
                    }
                }else{
                    $message = "Password Can't Verify!!";
                }



            }
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="shortcut icon" href="img/url_logo.jpg" type="image/x-icon">
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
</head>

<body id="login_body">

    <div class="container">
       <div id="login">
        <div class="login_form_box">
            <h1 class="display-6" style="text-align: center;">Login Form</h1>
            <div class="error_message"><?php echo $message; ?></div>
            <form action="login.php" method="post">
                <div class="mb-3">
                  <label class="form-label">Email address</label>
                  <input type="email" class="form-control" name="login_email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="login_password">
                  </div>
               
                <button type="submit" class="btn btn-info w-100" name="login">Submit</button>
              </form>
              <div class="text-center py-2 " id="login_signup">
                <a class="small" href="register.php">Create an Account!</a>
            </div>
        </div>
       </div>
    </div>



  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>

<?php

mysqli_close($connection);
?>
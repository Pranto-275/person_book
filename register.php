<?php
global $connection;
session_start();
include 'database/connection.php';
$message = '';
//
//if ($_SESSION['user_name']){
//    header('Location:index.php');
//}
//
//


if ($_SERVER['REQUEST_METHOD']=='POST'){
   if (isset($_POST['signup'])){
       $username = $_POST['username'];
       $email = $_POST['email'];
       $phone = $_POST['phone'];
       $password = $_POST['password'];
       $cpassword = $_POST['cpassword'];

       if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($cpassword) ){
           $message = "Please Fillup ALl Fields!!";
       } else{
           if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
               $message = "Invalid User Name";
           } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $message = "Invalid email";
           } else if($password != $cpassword){
               $message = "Password do not match!";
           }else{
               $user_unique_id = rand(10000,99999);
               $password = password_hash($password,PASSWORD_DEFAULT);

               $signup_query = "INSERT INTO users (user_id,user_name,email,phone,password,c_password) VALUES ('$user_unique_id','$username','$email','$phone','$password','$password')";
               $signup_query_result = mysqli_query($connection,$signup_query);
               if ($signup_query_result == 'ture'){
                   $message = "User Register Successfully!";
               }else{
                   $message = "User Creation Error!";
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
    <title>Registration</title>
    <link rel="shortcut icon" href="img/url_logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body id="login_body">

    <div class="container">
       <div id="login">
        <div class="login_form_box">
            <h1 class="display-6" style="text-align: center;">SignUp Form</h1>
            <div class="error_message"><?php echo $message; ?></div>
            <form action="register.php" method="post">
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="username">
              </div>
              
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control"  name="email">
              </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="number" class="form-control"  name="phone">
                </div>

                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control"  name="password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control"  name="cpassword">
                  </div>
               
                <button type="submit" class="btn btn-info w-100" name="signup">Sign Up</button>
              </form>
              <div class="text-center py-2"  id="login_signup">
                <a class="small" href="login.php">Already have an Account?</a>
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
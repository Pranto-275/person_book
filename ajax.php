<?php
global $connection;
include 'database/connection.php';
session_start();

$message = '';
if (!$_SESSION['user_name']) {
    header('Location:login.php');
}

$user_id = $_SESSION['user_id'];
$user_image = $_SESSION['user_image'];
$user_name = $_SESSION['user_name'];


if (isset($_POST['status_code']) == 123) {
    $status = $_POST['status'];
    if ($status == '' && !isset($_FILES["file"]["name"])) {
        echo "Field Should Not Leave empty!!";
    } else {
        if (isset($_FILES["file"]["name"]) && empty($status)) {
            $target_directory = "img/";
            $target_file = $target_directory . basename($_FILES["file"]["name"]);
            $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $newFilename = $target_directory . time() . "." . $filetype;

            $file_tmp_name = $_FILES["file"]["tmp_name"];

            $format = explode('.', $target_file);
            $file_extension = strtolower($format[1]);
            $allowed_format = ['jpg', 'jpeg', 'gif', 'png'];

            if (in_array($file_extension, $allowed_format)) {
                move_uploaded_file($file_tmp_name, $newFilename);
                $file_status_query = "INSERT INTO posts(user_id,image) VALUES ('$user_id','$newFilename')";
                $file_status_result = mysqli_query($connection, $file_status_query);
                if ($file_status_result == 'true') {
                    echo "Image Status Upload Successfully";
                } else {
                    echo "Failed";
                }

            } else {
                echo "This file will not support";
            }


        } else if (!isset($_FILES["file"]["name"]) && isset($status)) {
            $only_status_query = "INSERT INTO posts(user_id,posts) VALUES ('$user_id','$status')";
            $file_status_result = mysqli_query($connection, $only_status_query);
            if ($file_status_result == 'true') {
                echo "Status Upload Successfully";
            } else {
                echo "Failed";
            }
        } else {

            $target_directory = "img/";
            $target_file = $target_directory . basename($_FILES["file"]["name"]);
            $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $newFilename = $target_directory . time() . "." . $filetype;

            $file_tmp_name = $_FILES["file"]["tmp_name"];

            $format = explode('.', $target_file);
            $file_extension = strtolower($format[1]);
            $allowed_format = ['jpg', 'jpeg', 'gif', 'png'];

            if (in_array($file_extension, $allowed_format)) {
                move_uploaded_file($file_tmp_name, $newFilename);
                $image_and_status_query = "INSERT INTO posts(user_id,posts,image) VALUES ('$user_id','$status','$newFilename')";
                $file_and_image_status_result = mysqli_query($connection, $image_and_status_query);
                if ($file_and_image_status_result == 'true') {
                    echo "Post Upload Successfully";
                } else {
                    echo "Failed";
                }

            } else {
                echo "This file will not support";
            }

        }

    }


}


if (($_POST['code']) == 1234) {

//    $get_status_data = "SELECT * FROM posts ORDER BY post_id DESC";
    $get_status_data = "SELECT *  FROM posts JOIN users ON posts.user_id = users.user_id  ORDER BY post_id DESC";

    $get_status_list = mysqli_query($connection, $get_status_data);


    $arr = [];
    while ($row = mysqli_fetch_assoc($get_status_list)) {

        array_push($arr, $row);
    }

    echo json_encode($arr);

}


if ($_POST['code'] == 12345) {
    $get_user_post_id = $_POST['post_id'];
    $get_like_count = $_POST['addlike'];


    $user_post_react = "SELECT * FROM post_react WHERE user_id = '$user_id' AND post_id = '$get_user_post_id'";
    $user_post_react_result = mysqli_query($connection, $user_post_react);

    if (mysqli_num_rows($user_post_react_result)) {
        $unlike_delete = "DELETE  FROM post_react where post_id = '$get_user_post_id' AND user_id = '$user_id'";
        $unlike_delete_result = mysqli_query($connection, $unlike_delete);
        if ($unlike_delete_result == 'true') {

            $react_delete_count_query = "SELECT count(*) as reacts FROM post_react WHERE post_id = '$get_user_post_id' ";
            $total_delete_react_result = mysqli_query($connection, $react_delete_count_query);

            $row = mysqli_fetch_assoc($total_delete_react_result);
            $total_react = $row['reacts'];
            $store_delete_total_query = "UPDATE posts SET like_count = '$total_react' WHERE  post_id = '$get_user_post_id'";
            $store_delete_total_query_result = mysqli_query($connection, $store_delete_total_query);
            if ($store_delete_total_query_result == 'true') {
                echo $total_react;
            }

        }
    } else {
        $react_query = "INSERT INTO post_react(user_id,post_id,react) VALUES ('$user_id','$get_user_post_id',$get_like_count)";
        $react_query_result = mysqli_query($connection, $react_query);
        $react_count_query = "SELECT count(*) as reacts FROM post_react WHERE post_id = '$get_user_post_id' ";
        $total_react_result = mysqli_query($connection, $react_count_query);

        $row = mysqli_fetch_assoc($total_react_result);
        $total_react = $row['reacts'];
        $store_total_query = "UPDATE posts SET like_count = '$total_react' WHERE  post_id = '$get_user_post_id'";
        $store_total_query_result = mysqli_query($connection, $store_total_query);


        if ($store_total_query_result == 'ture') {
            echo $total_react;
        }

    }

}


if ($_POST['code'] == 222) {
    $get_post = $_POST['post_id'];

    $check_react_query = "SELECT post_id FROM post_react WHERE post_id = '$get_post' AND user_id = '$user_id'";
    $check_react_result = mysqli_query($connection, $check_react_query);
    $arr = [];
    while ($row = mysqli_fetch_assoc($check_react_result)) {
        array_push($arr, $row);

    }
    echo json_encode($arr);

}


//profile
if (($_POST['code']) == 242424) {


    // $get_status_data = "SELECT *  FROM posts JOIN users ON posts.user_id = users.user_id WHERE posts.user_id = '$user_id'  ORDER BY post_id DESC";
    $get_status_data = "SELECT * FROM posts  WHERE user_id = '$user_id'  ORDER BY post_id DESC";

    $get_status_list = mysqli_query($connection, $get_status_data);


    $arr = [];
    while ($row = mysqli_fetch_assoc($get_status_list)) {

        array_push($arr, $row);
    }

    echo json_encode($arr);

}


//profile
if (($_POST['code']) == 852) {
    $post_id = $_POST['post_id'];
    $delete_post_query = "DELETE FROM posts where post_id = '$post_id'";
    $delete_post_query_result = mysqli_query($connection, $delete_post_query);

    if ($delete_post_query_result == 'ture') {
        $delete_post_like_query = "DELETE FROM post_react where post_id = '$post_id'";
        $delete_psot_react_result = mysqli_query($connection, $delete_post_like_query);
    }

    echo "Post deleted Successfully!!";

}

//profile
if (($_POST['code']) == 35275) {


    $user_name = $_POST['profile_name'];
    $user_email = $_POST['user_email'];


    if ($user_email == '' && $user_name == '' && !isset($_FILES["profile_image"]["name"]) && !isset($_FILES["cover_image"]["name"])) {
        echo "Field Should Not Leave empty!!";
    } else {

        if (isset($_FILES["profile_image"]["name"]) && empty($user_name) && empty($user_email) && !isset($_FILES["cover_image"]["name"])) {
            $target_directory = "img/";
            $target_file = $target_directory . basename($_FILES["profile_image"]["name"]);
            $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $newFilename = $target_directory . time() . "." . $filetype;

            $file_tmp_name = $_FILES["profile_image"]["tmp_name"];

            $format = explode('.', $target_file);
            $file_extension = strtolower($format[1]);
            $allowed_format = ['jpg', 'jpeg', 'gif', 'png'];

            if (in_array($file_extension, $allowed_format)) {
                move_uploaded_file($file_tmp_name, $newFilename);
                $file_update_query = "UPDATE users SET profile_image = '$newFilename' WHERE  user_id = '$user_id'";
                $file_update_result = mysqli_query($connection, $file_update_query);
                if ($file_update_result == 'true') {
                    echo "Profile Pic Successfully";
                } else {
                    echo "Failed";
                }

            } else {
                echo "This file will not support";
            }


        } else if (!isset($_FILES["profile_image"]["name"]) && empty($user_email) && !isset($_FILES["cover_image"]["name"])) {
            $only_name_upadte_query = "UPDATE users SET user_name = '$user_name' WHERE  user_id = '$user_id'";
            $only_name_upadte_result = mysqli_query($connection, $only_name_upadte_query);
            if ($only_name_upadte_result == 'true') {
                echo "Status Upload Successfully";
            } else {
                echo "Failed";
            }
        } else if (!isset($_FILES["profile_image"]["name"]) && empty($user_name) && !isset($_FILES["cover_image"]["name"])) {
            $only_email_upadte_query = "UPDATE users SET email = '$user_email' WHERE  user_id = '$user_id'";
            $only_email_upadte_result = mysqli_query($connection, $only_email_upadte_query);
            if ($only_email_upadte_result == 'true') {
                echo "Email Update Successfully";
            } else {
                echo "Failed";
            }
        } else if (!isset($_FILES["profile_image"]["name"]) && empty($user_name) && empty($user_email)) {

            $target_directory = "img/";
            $target_file = $target_directory . basename($_FILES["cover_image"]["name"]);
            $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $newFilename = $target_directory . time() . "." . $filetype;

            $file_tmp_name = $_FILES["cover_image"]["tmp_name"];

            $format = explode('.', $target_file);
            $file_extension = strtolower($format[1]);
            $allowed_format = ['jpg', 'jpeg', 'gif', 'png'];

            if (in_array($file_extension, $allowed_format)) {
                move_uploaded_file($file_tmp_name, $newFilename);
                $cover_image_update_query = "UPDATE users SET cover_image = '$newFilename' WHERE  user_id = '$user_id'";
                $cover_image_update_result = mysqli_query($connection, $cover_image_update_query);
                if ($cover_image_update_result == 'true') {
                    echo "Cover Image Update Successfully";
                } else {
                    echo "Failed";
                }


            } else {
                echo "This file will not support";
            }

        } else {

            $target_directory = "img/";
            $target_file = $target_directory . basename($_FILES["profile_image"]["name"]);
            $cover_image_target_file = $target_directory . basename($_FILES["cover_image"]["name"]);


            $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $cover_image_filetype = strtolower(pathinfo($cover_image_target_file, PATHINFO_EXTENSION));


            $newFilename = $target_directory . time() . "." . $filetype;
            $cover_image_newFilename = $target_directory . time() . time() . "." . $cover_image_filetype;


            $file_tmp_name = $_FILES["profile_image"]["tmp_name"];
            $cover_image_file_tmp_name = $_FILES["cover_image"]["tmp_name"];


            $format = explode('.', $target_file);
            $file_extension = strtolower($format[1]);
            $allowed_format = ['jpg', 'jpeg', 'gif', 'png'];

            $cover_format = explode('.', $cover_image_target_file);
            $cover_image_file_extension = strtolower($cover_format[1]);


            if (in_array($file_extension, $allowed_format)) {
                move_uploaded_file($file_tmp_name, $newFilename);

                if (in_array($cover_image_file_extension, $allowed_format)) {
                    move_uploaded_file($cover_image_file_tmp_name, $cover_image_newFilename);


                    $all_data_update_query = "UPDATE users SET user_name = '$user_name',email='$user_email', profile_image = '$newFilename', cover_image = '$cover_image_newFilename'  WHERE  user_id = '$user_id'";
                    $all_data_update_query_result = mysqli_query($connection, $all_data_update_query);

                    if ($all_data_update_query_result == 'true') {
                        echo "Data Update Successfully";
                    } else {
                        echo "Failed";
                    }

                }


            } else {
                echo "This file will not support";
            }

        }
    }


}


//new peoples show

if (($_POST['code']) == 1212) {
    $user = '';

    $checkfriend = "Select * FROM friends WHERE user_one = '$user_id' OR user_two = '$user_id'";
    $check_addfriend_result = mysqli_query($connection, $checkfriend);
    $added_friend = array();
    while ($row = mysqli_fetch_assoc($check_addfriend_result)) {
        if ($row['user_two'] == $user_id) {
            $added_friend[] = $row['user_one'];


        } else {
            $added_friend[] = $row['user_two'];
        }

    }

    $show_connected_friends = implode("','", $added_friend);


    $show_all_friends = "SELECT user_name,profile_image,user_id FROM users WHERE user_id NOT IN ('$user_id', '$show_connected_friends')  ORDER BY ID DESC  LIMIT 5  ";

    $show_all_friends_result = mysqli_query($connection, $show_all_friends);
    $arr = [];
    while ($row = mysqli_fetch_assoc($show_all_friends_result)){
        array_push($arr, $row);
    }
    echo json_encode($arr);

}


if (($_POST['code']) == 1313) {

    $friend_id = $_POST['friend_reqest_user_id'];


    $check_user_and_friend = "SELECT * FROM friend_request WHERE sender = '$user_id' AND receiver_id = '$friend_id'";

    $check_user_and_friend_result = mysqli_query($connection, $check_user_and_friend);
    if (mysqli_num_rows($check_user_and_friend_result)) {

        $delete_request = "DELETE  FROM friend_request WHERE sender = '$user_id' AND receiver_id = '$friend_id'";
        $delete_request_result = mysqli_query($connection, $delete_request);

        if ($delete_request_result == 'true') {
            echo "Add";
        }

    } else {
        $send_request_query = "INSERT INTO friend_request (sender,receiver_id) VALUES ('$user_id','$friend_id')";
        $send_request_query_result = mysqli_query($connection, $send_request_query);

        if ($send_request_query_result == 'true') {
            echo "Cancel";
        }
    }


}


if (($_POST['code']) == 1414) {
    $friend_id = $_POST['get_frinend_id'];
    $check_request_query = "SELECT * FROM friend_request WHERE sender = '$user_id' AND receiver_id = '$friend_id'";

    $check_request_query_result = mysqli_query($connection, $check_request_query);
    $arr = [];
    while ($row = mysqli_fetch_assoc($check_request_query_result)) {
        array_push($arr, $row);

    }
    echo json_encode($arr);

}


if (($_POST['code']) == 1515) {
    $notification = "SELECT count(*) as notifacation FROM friend_request WHERE receiver_id = '$user_id' ";
    $notification_result = mysqli_query($connection, $notification);

    $row = mysqli_fetch_assoc($notification_result);

    $notification_result_count = $row['notifacation'];
    echo $notification_result_count;


}


if (($_POST['code']) == 1616) {
    $request_list = "SELECT user_id,user_name,profile_image FROM users JOIN friend_request ON users.user_id = friend_request.sender WHERE friend_request.receiver_id = '$user_id'";
    $request_list_result = mysqli_query($connection, $request_list);

    $arr = [];
    while ($row = mysqli_fetch_assoc($request_list_result)) {
        array_push($arr, $row);

    }
    echo json_encode($arr);
}


//delete request

if (($_POST['code']) == 1717) {
    $requester_id = $_POST['requester_id_value'];

    $reqest_delete = "DELETE FROM friend_request  where sender = '$requester_id' AND receiver_id = '$user_id'";
    $reqest_delete_query = mysqli_query($connection, $reqest_delete);

    if ($reqest_delete_query == 'true') {
        echo "You Delete A Friend Request";
    }


}


//accept request


if (($_POST['code']) == 1818) {
    $requester_id = $_POST['requester_id_value'];

    //user_one will be receiver and user_two will be sender
    $accept_request_query = "INSERT INTO friends (user_one,user_two) VALUES ('$requester_id','$user_id')";
    $accept_request_query_result = mysqli_query($connection, $accept_request_query);

    if ($accept_request_query_result == 'true') {

        $reqest_delete = "DELETE FROM friend_request  where sender = '$requester_id' AND receiver_id = '$user_id'";
        $reqest_delete_query = mysqli_query($connection, $reqest_delete);

        if ($accept_request_query_result == 'true') {
            echo "You Guys Are Connected";
        }


    }

}


//connected friends

if (($_POST['code']) == 1919) {


    $previous_added_friend_query = "Select user_one,user_two from friends WHERE user_two = '$user_id' OR user_one = '$user_id' ";
    $previous_added_friend_query_result = mysqli_query($connection, $previous_added_friend_query);

    $arr = [];

    while ($row = mysqli_fetch_assoc($previous_added_friend_query_result)) {


            if ($row['user_one'] != $user_id){

                $added_friend = $row['user_one'];



                $connected_friends_query = "SELECT user_name,user_id,profile_image FROM `users` WHERE user_id = (Select user_one from friends WHERE user_one = '$added_friend' AND user_two = '$user_id')
                                                      OR user_id = (Select user_one from friends WHERE user_one = '$user_id' AND user_two = '$added_friend')";
                $connected_friends_query_result = mysqli_query($connection, $connected_friends_query);

                while ($row = mysqli_fetch_assoc($connected_friends_query_result)) {
                    array_push($arr, $row);


                }

            }else{

                $added_friend = $row['user_two'];

                $connected_friends_query = "SELECT user_name,user_id,profile_image FROM `users` WHERE user_id = (Select user_two from friends WHERE user_one = '$added_friend' AND user_two = '$user_id')
                                                      OR user_id = (Select user_two from friends WHERE user_one = '$user_id' AND user_two = '$added_friend')";
                $connected_friends_query_result = mysqli_query($connection, $connected_friends_query);

                while ($row = mysqli_fetch_assoc($connected_friends_query_result)) {
                    array_push($arr, $row);


                }

            }



    }

    echo json_encode($arr);


}



if (($_POST['code']) == 2323) {
    $user = '';

    $checkfriend = "Select * FROM friends WHERE user_one = '$user_id' OR user_two = '$user_id'";
    $check_addfriend_result = mysqli_query($connection, $checkfriend);
    $added_friend = array();
    while ($row = mysqli_fetch_assoc($check_addfriend_result)) {
        if ($row['user_two'] == $user_id) {
            $added_friend[] = $row['user_one'];


        } else {
            $added_friend[] = $row['user_two'];
        }

    }

    $show_connected_friends = implode("','", $added_friend);


    $show_all_friends = "SELECT user_name,profile_image,user_id FROM users WHERE user_id NOT IN ('$user_id', '$show_connected_friends')  ORDER BY id DESC ";

    $show_all_friends_result = mysqli_query($connection, $show_all_friends);
    $arr = [];
    while ($row = mysqli_fetch_assoc($show_all_friends_result)){
        array_push($arr, $row);
    }
    echo json_encode($arr);

}


//if (($_POST['code'])== 2626){
//    $people_profile_id = $_POST['people_profile_id'];
//
//    header("Location:peoples_profile.php");
//
//
//}

<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'personbook';
$connection = mysqli_connect($servername,$username,$password,$dbname);

if(!$connection){
    die("Database Connection Error".mysqli_connect_error());
}
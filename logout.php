<?php

global $connection;
include 'database/connection.php';
session_start();
session_destroy();
header('Location:login.php');

<?php

$host = "localhost";
$uname = "root";
$pass = "";
$db = "picfolio";

$conn = mysqli_connect($host, $uname, $pass, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to Database: " . mysqli_connect_error();
    exit();
}

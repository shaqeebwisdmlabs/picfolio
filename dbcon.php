<?php

$hostname = "localhost";
$uname = "root";
$pass = "";
$db = "picfolio";

$con = mysqli_connect($hostname, $uname, $pass, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

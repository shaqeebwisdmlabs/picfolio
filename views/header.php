<?php
require_once "./config/dbconn.php";
require_once "./models/User.php";
require_once "./models/Image.php";

session_start();

$user_id = null;

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@800,500,700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Picfolio</title>
</head>

<body>
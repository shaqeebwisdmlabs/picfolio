<?php
include_once("views/header.php");

if (isset($_SESSION['user_id'])) {
    require('home.php');
} else {
    require('login.php');
}

include_once("views/footer.php");

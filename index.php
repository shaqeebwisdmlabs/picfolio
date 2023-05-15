<?php
include_once("views/header.php");

if (isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id'])) {
    include('home.php');
} else {
    include('login.php');
}

include_once("views/footer.php");

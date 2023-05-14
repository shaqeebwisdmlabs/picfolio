<?php
require_once "./config/dbconn.php";
require_once "./models/User.php";

session_start();

$image_id = $_GET['id'];

if ($_SESSION['user_id']) {
    $query = "SELECT * FROM images WHERE id = '$image_id'";
    $result = mysqli_query($conn, $query);
    $image = mysqli_fetch_assoc($result);
    $filename = $image['filename'];

    $upload_dir = 'uploads/';
    unlink($upload_dir . $filename);

    $query = "DELETE FROM images WHERE id = '$image_id'";
    $result = mysqli_query($conn, $query);

    header("Location: home.php");
    exit();
}

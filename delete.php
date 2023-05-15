<?php
include_once("views/header.php");

$image_id = $_GET['id'];

if (isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id'])) {
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

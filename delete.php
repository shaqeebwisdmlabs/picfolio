<?php
include_once("views/header.php");

$salt = "POzxNTvFtNQqjzgJFwou";
$encrypted_id = $_GET['id'];
$decrypted_id_raw = base64_decode($encrypted_id);
$image_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);

$userModel = new User($conn);
$imageModel = new Image($conn);
$imageController = new ImageController($userModel, $imageModel);
$errors = $imageController->delete($conn, $image_id);

<?php

require_once "./models/UserModel.php";
require_once "./controllers/AuthController.php";

$userModel = new User($conn);
$authController = new AuthController($userModel);
$authController->logout();

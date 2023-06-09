<?php include_once("views/header.php");

$userModel = new User($conn);
$authController = new AuthController($userModel);
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $errors = $authController->login($email, $password);
}

include("views/login-form.php");

include("views/footer.php");

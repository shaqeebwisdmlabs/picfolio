<?php include("views/header.php");

$userModel = new User($conn);
$authController = new AuthController($userModel);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $errors = $authController->signup($name, $email, $password);
}

include("views/signup-form.php");
include("views/footer.php");

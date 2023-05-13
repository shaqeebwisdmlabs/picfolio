<?php
require_once "./config/dbconn.php";
require_once "./models/User.php";

session_start();

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate email
    if (empty($email)) {
        $errors["email"] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    // Validate password
    if (empty($password)) {
        $errors["password"] = "Password is required";
    }

    $userModel = new User($conn);
    $user = $userModel->findUserByEmail($email);
    echo $user;
    if ($user && password_verify($password, $user["password"]) && empty($errors)) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: home.php");
        exit();
    } else {
        $errors["login"] = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@800,500,700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Picfolio | Login</title>
</head>

<body>
    <div class="wrapper login-wrapper">
        <div class="form-container">
            <div class="logo">
                <img src="./assets/images/logo-icon.png" alt="" height="24px" width="24px">
                <h1 class="fw-bold fs-title-sm">Picfolio</h1>
            </div>
            <div class="login">
                <h3 class="fw-black fs-title-lg" style="text-align:center">Log In to your accout</h3>
                <p class="text-neutral-300 fs-body-sm fw-medium"
                    style="max-width:95%; text-align:center;margin-top:0.5em">Welcome
                    back, login to
                    your
                    account and continue where you left</p>

                <form class="login-form" action="" method="post">
                    <div class="input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email"
                            value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>">
                        <?php if (!empty($errors["email"])) : ?>
                        <span class="error"><?php echo $errors["email"]; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="********">
                        <?php if (!empty($errors["password"])) : ?>
                        <span class="error"><?php echo $errors["password"]; ?></span>
                        <?php endif; ?>
                    </div>

                    <button class="btn btn--submit" type="submit">Login</button>
                    <?php if (!empty($errors["login"])) : ?>
                    <span class="error"><?php echo $errors["login"]; ?></span>
                    <?php endif; ?>

                    <p class="fs-body-sm">New to picfolio?
                        <a href="/signup.php" class="text-neutral-900 fw-bold">Sign Up</a>
                    </p>
                </form>
            </div>
        </div>
        <div class="image-container">
        </div>
    </div>
</body>

</html>
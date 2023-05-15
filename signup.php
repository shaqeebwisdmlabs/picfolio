<?php include("views/header.php"); ?>

<?php
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate name
    if (empty($name)) {
        $errors["name"] = "Name is required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors["name"] = "Only letters and white space allowed";
    }

    // Validate email
    if (empty($email)) {
        $errors["email"] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    // Validate password
    if (empty($password)) {
        $errors["password"] = "Password is required";
    } else if (strlen($password) < 8) {
        $errors["password"] = "Password must be at least 8 characters long";
    }

    $userModel = new User($conn);
    $user = $userModel->findUserByEmail($email);
    if ($user) {
        $errors["email"] = "Email is already registered";
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userModel->createUser($name, $email, $hashedPassword);

        $user = $userModel->findUserByEmail($email);
        session_start();
        $_SESSION["user_id"] = $user["user_id"];

        header("Location: /home.php");
        exit();
    }
}
?>

<div class="wrapper signup-wrapper">
    <div class="form-container">
        <div class="logo">
            <img src="./assets/images/logo-icon.png" alt="" height="24px" width="24px">
            <h1 class="fw-bold fs-title-sm">Picfolio</h1>
        </div>
        <div class="signup">
            <h3 class="fw-black fs-title-lg" style="text-align:center">Create your accout</h3>
            <p class="text-neutral-300 fs-body-sm" style="max-width:95%; text-align:center;margin-top:0.5em">Create
                your account and get 30 day free trial</p>

            <form class="signup-form" action="" method="POST">

                <div class="input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your full name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>">
                    <?php if (!empty($errors["name"])) : ?>
                        <span class="error"><?php echo $errors["name"]; ?></span>
                    <?php endif; ?>
                </div>

                <div class="input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>">
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

                <button class="btn btn--submit" type="submit" value="submit">Sign Up</button>

                <p class="fs-body-sm">Already have an account?
                    <a href="/" class="text-neutral-900 fw-bold">Login</a>
                </p>
            </form>
        </div>
    </div>
    <div class="image-container">
    </div>
</div>

<?php include("views/footer.php"); ?>
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
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>

                    <div class="input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="********" required>
                    </div>

                    <button class="btn btn--submit" type="submit">Login</button>

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
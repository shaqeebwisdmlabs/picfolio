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
                    <input type="text" name="name" id="name" placeholder="Enter your full name"
                        value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>">
                    <?php if (!empty($errors["name"])) : ?>
                    <span class="error"><?php echo $errors["name"]; ?></span>
                    <?php endif; ?>
                </div>

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

                <button class="btn btn--submit" type="submit" name="signup">Sign Up</button>

                <p class="fs-body-sm">Already have an account?
                    <a href="/" class="text-neutral-900 fw-bold">Login</a>
                </p>
            </form>
        </div>
    </div>
    <div class="image-container">
    </div>
</div>
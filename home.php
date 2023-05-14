<?php
require_once "./config/dbconn.php";
require_once "./models/User.php";

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@800,500,700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Picfolio | Gallery</title>
</head>

<body>
    <header class="container primary-header">
        <div class="logo">
            <img src="./assets/images/logo-icon.png" alt="" height="24px" width="24px">
            <h1 class="fw-bold fs-title-sm">Picfolio</h1>
        </div>
        <div class="header-btns">
            <a href="/upload.php" class="btn btn--upload" style="text-decoration:none">
                Upload
            </a>
            <a href="/logout.php" class="btn btn--logout" style="text-decoration:none" class="fw-bold">
                Logout
            </a>
        </div>
    </header>
    <main style="display:grid;place-items:center">
        <section class="container gallery">
            <h3 class="fw-bold fs-title">Your Gallery</h3>

            <div class="image-grid">

                <?php
                $userModel = new User($conn);
                $images = $userModel->fetchImage($user_id);

                if ($images) {
                    foreach ($images as $image) {
                        $filename = $image['filename'];
                        $image_title = $image['image_title']; ?>

                <div class='image'>
                    <img src='uploads/<?php echo $filename; ?>' alt='<?php echo $image_title; ?>'>
                    <div class='image-overlay'>
                        <p class='image-title fw-bold'><?php echo $image_title; ?></p>
                        <div class='image-actions'>
                            <button class='btn--action'>
                                <img src='./assets/images/share-icon.svg' alt=''>
                            </button>
                            <button class='btn--action'
                                onclick="location.href='update.php?id=<?php echo $image['id']; ?>'"><img
                                    src='./assets/images/edit-icon.svg' alt=''></button>
                            <button class='btn--action'><img src='./assets/images/delete-icon.svg' alt=''></button>
                        </div>
                    </div>
                </div>
                <?php }
                } else {
                    echo "<div><h3 class='fw-bold fs-title'>You haven't uploaded any images yet!</h3></div>";
                }
                ?>


            </div>
        </section>
    </main>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
</body>

</html>
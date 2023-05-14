<?php
require_once "./config/dbconn.php";
require_once "./models/User.php";

session_start();
$user_id = $_SESSION["user_id"];

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $image_title = $_POST["image-title"];

    if (empty($image_title)) {
        $errors["image_title"] = "Title is required";
    }

    $image = $_FILES["image"];
    $image_name =  pathinfo($image["name"], PATHINFO_FILENAME);
    $image_size = $image["size"];
    $image_ext = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    $image_tmp_loc = $image["tmp_name"];

    $max_image_size = 5 * 1024 * 1024; // 5MB
    if ($image_size > $max_image_size) {
        $errors["limit_exceed"] = "Image size must be less than 5MB";
    }

    $unique_name = uniqid() . "-" . $image_name . "." . $image_ext;
    $upload_dir = 'uploads/';
    $upload_path = $upload_dir .  $unique_name;

    if (empty($errors)) {
        if (!move_uploaded_file($image_tmp_loc, $upload_path)) {
            $errors["upload"] = "Something went wrong while uploading!";
        }
    }

    if (empty($errors)) {
        $userModel = new User($conn);
        $upload = $userModel->uploadImage($user_id, $unique_name, $image_title);
        if (!$upload) {
            $errors["upload"] = "Something went wrong while uploading into database!";
        }
        header("Location: home.php");
        exit();
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
    <title>Picfolio | Upload Image</title>
</head>

<body>

    <header class="container primary-header">
        <div class="logo">
            <img src="./assets/images/logo-icon.png" alt="" height="24px" width="24px">
            <h1 class="fw-bold fs-title-sm">Picfolio</h1>
        </div>
        <div class="header-btns">
            <a href="/home.php" style="text-decoration:none;margin-right:1em" class="fw-bold text-neutral-900">Gallery</a>
            <a href="/logout.php" class="btn btn--logout" style="text-decoration:none" class="fw-bold">
                Logout
            </a>
        </div>
    </header>
    <main style="display:grid;place-items:center">
        <form class="image-form" method="POST" enctype="multipart/form-data" action="upload.php">
            <section class="upload-files | bg-neutral-100 box-shadow">
                <h3 class="fw-bold fs-title">Upload Image</h3>
                <div class="upload-area">
                    <div class="upload--icon">
                        <img src="./assets/images/file-icon.svg" draggable="false" />
                    </div>
                    <p class="fw-medium">Drag and Drop your images here</p>
                    <span class="separator | fs-body-sm text-neutral-500">or</span>
                    <label for="image" class="btn-choose">
                        Choose File
                    </label>
                    <input type="file" name="image" id="image" accept="image/*" hidden />
                    <span class="fs-body-x-sm text-neutral-500">
                        Max file size 5MB
                    </span>
                </div>
            </section>
            <div class="image-preview">

                <h4 class="fw-bold fs-body">Image Preview</h4>
                <img src="" alt="" id="preview">
                <div class="input" style="margin-top: 3em;">
                    <label for="image-title">Image Title</label>
                    <input type="text" name="image-title" id="image-title" placeholder="Enter image title" value="<?php echo isset($_POST["image-title"]) ? $_POST["image-title"] : ""; ?>">
                </div>
                <input class="btn btn--submit" type="submit" value="Upload">

                <?php if (!empty($errors["upload"])) : ?>
                    <span class="error"><?php echo $errors["upload"]; ?></span>
                <?php endif; ?>

                <?php if (!empty($errors["limit_exceed"])) : ?>
                    <span class="error"><?php echo $errors["limit_exceed"]; ?></span>
                <?php endif; ?>

                <?php if (!empty($errors["image"])) : ?>
                    <span class="error"><?php echo $errors["image"]; ?></span>
                <?php endif; ?>

                <?php if (!empty($errors["image_title"])) : ?>
                    <span class="error"><?php echo $errors["image_title"]; ?></span>
                <?php endif; ?>
            </div>
        </form>

    </main>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
</body>

</html>
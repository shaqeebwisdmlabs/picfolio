<?php
require_once "./config/dbconn.php";
require_once "./models/User.php";

$image_id = $_GET['id'];

echo "<script>console.log(" . json_encode($image_id) . ");</script>";

$errors = array();

$query = "SELECT * FROM images WHERE id = '$image_id'";
$result = mysqli_query($conn, $query);
$image = mysqli_fetch_assoc($result);


if (isset($_POST['update']) && isset($_POST['image-title'])) {
    $new_title = $_POST['image-title'];

    if (empty($new_title)) {
        $errors["image_title"] = "Title is required";
    }

    if (empty($errors)) {
        $userModel = new User($conn);
        $update = $userModel->updateImageTitle($image_id, $new_title);
        if (!$upload) {
            $errors["upload"] = "Something went wrong while updating";
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
    <title>Picfolio | Update Image</title>
</head>

<body>

    <header class="container primary-header">
        <div class="logo">
            <img src="./assets/images/logo-icon.png" alt="" height="24px" width="24px">
            <h1 class="fw-bold fs-title-sm">Picfolio</h1>
        </div>
        <div class="header-btns">
            <a href="/home.php" style="text-decoration:none;margin-right:1em"
                class="fw-bold text-neutral-900">Gallery</a>
            <a href="/logout.php" class="btn btn--logout" style="text-decoration:none" class="fw-bold">
                Logout
            </a>
        </div>
    </header>
    <main style="display:grid;place-items:center">
        <form class="image-form" method="POST">
            <div class="image-preview">
                <h4 class="fw-bold fs-body">Image Preview</h4>
                <img src="uploads/<?php echo $image['filename']; ?>" alt="" id="preview">
                <div class="input" style="margin-top: 3em;">
                    <label for="image-title">Image Title</label>
                    <input type="text" name="image-title" id="image-title" placeholder="Enter image title">
                </div>
                <input class="btn btn--submit" type="submit" name="update" value="Update">

                <?php if (!empty($errors["upload"])) : ?>
                <span class="error"><?php echo $errors["upload"]; ?></span>
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
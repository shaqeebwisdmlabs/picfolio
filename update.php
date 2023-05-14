<?php include("views/header.php"); ?>

<?php
require_once "./models/User.php";

$image_id = $_GET['id'];

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

<?php include("views/navbar-upload.php"); ?>

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

<?php include("views/footer.php"); ?>
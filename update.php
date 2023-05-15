<?php include("views/header.php"); ?>

<?php
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
        $imageModel = new Image($conn);
        $update = $imageModel->updateImageTitle($image_id, $new_title);
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

    <?php include("views/update-form.php"); ?>

</main>

<?php include("views/footer.php"); ?>
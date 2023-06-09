<?php include("views/header.php"); ?>

<?php
$salt = "POzxNTvFtNQqjzgJFwou";
$encrypted_id = $_GET['id'];
$decrypted_id_raw = base64_decode($encrypted_id);
$image_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);

$userModel = new User($conn);
$imageModel = new Image($conn);
$imageController = new ImageController($userModel, $imageModel);

$result = $imageModel->fetchImageById($image_id);
$image = mysqli_fetch_assoc($result);

$errors = $imageController->update($image_id);
?>

<?php include("views/navbar-upload.php"); ?>

<main style="display:grid;place-items:center">

    <?php include("views/update-form.php"); ?>

</main>

<?php include("views/footer.php"); ?>
<?php include("views/header.php"); ?>
<?php

$userModel = new User($conn);
$imageModel = new Image($conn);
$imageController = new ImageController($userModel, $imageModel);
$errors = $imageController->upload($user_id);

include("views/navbar-upload.php"); ?>

<main style="display:grid;place-items:center">

    <?php include("views/upload-form.php"); ?>

</main>

<?php include("views/footer.php"); ?>
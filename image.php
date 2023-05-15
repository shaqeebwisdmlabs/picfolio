<?php include("views/header.php"); ?>
<?php include("views/navbar-upload.php"); ?>

<?php
$image_id = $_GET['id'];
$imageModel = new Image($conn);
$result = $imageModel->fetchImageById($image_id);
$single_image = mysqli_fetch_assoc($result);
?>

<?php include("views/carousel.php"); ?>

<?php include("views/footer.php"); ?>
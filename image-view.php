<?php include("views/header.php"); ?>
<?php include("views/navbar-upload.php"); ?>

<?php
$image_id = $_GET['id'];
$imageModel = new Image($conn);
$result = $imageModel->fetchImageById($image_id);
$single_image = mysqli_fetch_assoc($result);
?>

<?php
if (isset($_SESSION['user_id'])) {
?>

<div class="image-view">
    <img src="uploads/<?php echo $single_image['filename'] ?>" alt="<?php echo $single_image['image_title'] ?>">
</div>

<?php } else {
    header("Location: login.php");
} ?>

<?php include("views/footer.php"); ?>
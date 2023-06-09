<?php include("views/header.php"); ?>
<?php include("views/navbar-upload.php"); ?>

<?php
$salt = "POzxNTvFtNQqjzgJFwou";
$encrypted_id = $_GET['id'];
$decrypted_id_raw = base64_decode($encrypted_id);
$image_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);

if (!$image_id) {
    header('Location: 404.php');
    exit();
}

$imageModel = new Image($conn);
$result = $imageModel->fetchImageById($image_id);
$single_image = mysqli_fetch_assoc($result);


if (!$single_image) {
    header('Location: 404.php');
    exit();
}

if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<div class="image-view">
    <img src="uploads/<?php echo $single_image['filename'] ?>" alt="<?php echo $single_image['image_title'] ?>">
</div>

<?php include("views/footer.php"); ?>
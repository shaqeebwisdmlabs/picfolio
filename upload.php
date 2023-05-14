<?php include("views/header.php"); ?>
<?php
require_once "./models/User.php";

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

<?php include("views/navbar-upload.php"); ?>

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

<?php include("views/footer.php"); ?>
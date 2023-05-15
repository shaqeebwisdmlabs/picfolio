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
            <input type="text" name="image-title" id="image-title" placeholder="Enter image title"
                value="<?php echo isset($_POST["image-title"]) ? $_POST["image-title"] : ""; ?>">
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
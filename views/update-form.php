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
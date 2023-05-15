<h3 class="fw-bold fs-title">Your Gallery</h3>

<div class="image-grid">
    <?php
    foreach ($images as $image) {
        $filename = $image['filename'];
        $image_title = $image['image_title'];
    ?>
    <div class='image'>
        <img src='uploads/<?php echo $filename; ?>' alt='<?php echo $image_title; ?>' loading="lazy">
        <div class='image-overlay'>
            <a href="/image.php?id=<?php echo $image['id']; ?>" class='image-title fw-bold'>
                <?php echo $image_title; ?>
            </a>
            <div class='image-actions'>
                <button class='btn--action'
                    onclick="copyToClipboard('<?php echo 'http:\/\/picfolio.com/image-view.php?id=' . $image['id'] ?>')">
                    <img src='./assets/images/share-icon.svg' alt=''>
                </button>
                <button class='btn--action' onclick="location.href='update.php?id=<?php echo $image['id']; ?>'"><img
                        src='./assets/images/edit-icon.svg' alt=''></button>
                <button class='btn--action' onclick="location.href='delete.php?id=<?php echo $image['id']; ?>'"><img
                        src='./assets/images/delete-icon.svg' alt=''></button>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
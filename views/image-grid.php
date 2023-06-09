<h3 class="fw-bold fs-title">Your Gallery</h3>

<div class="image-grid">
    <?php
    $salt = "POzxNTvFtNQqjzgJFwou";

    ?>
    <?php
    foreach ($images as $image) {
        $filename = $image['filename'];
        $image_title = $image['image_title'];
        $image_id = $image['id'];
        $encrypted_id = base64_encode($image_id . $salt);
    ?>
        <div class='image'>
            <img class="lazy" data-src='uploads/<?php echo $filename; ?>' src="assets/images/placeholder-image.png" alt='<?php echo $image_title; ?>' loading="lazy">
            <div class='image-overlay'>
                <a href="/image.php?id=<?php echo $image['id']; ?>" class='image-title fw-bold'>
                    <?php echo $image_title; ?>
                </a>
                <div class='image-actions'>
                    <button class='btn--action' onclick="copyToClipboard('<?php echo 'http:\/\/picfolio.com/image-view.php?id=' . $encrypted_id ?>')">
                        <img src='./assets/images/share-icon.svg' alt=''>
                    </button>
                    <a class='btn--action' href="update.php?id=<?php echo $encrypted_id; ?>"><img src='./assets/images/edit-icon.svg' alt=''></a>
                    <a class="btn--action" href="delete.php?id=<?php echo $encrypted_id; ?>" onclick="return confirm('Do you want to delete this image?')"><img src='./assets/images/delete-icon.svg' alt=''></a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    let lazyImages = Array.from(document.querySelectorAll('.lazy'));

    function lazyLoad() {
        lazyImages.forEach((image) => {
            if (image.getBoundingClientRect().top <= window.innerHeight && image.getBoundingClientRect()
                .bottom >= 0) {
                image.src = image.dataset.src;
                image.classList.remove('lazy');

                lazyImages = lazyImages.filter((img) => {
                    return img !== image;
                });

                if (lazyImages.length === 0) {
                    document.removeEventListener('scroll', lazyLoad);
                    window.removeEventListener('resize', lazyLoad);
                    window.removeEventListener('orientationchange', lazyLoad);
                }
            }
        });
    }

    window.addEventListener('DOMContentLoaded', lazyLoad);
    window.addEventListener('scroll', lazyLoad);
    window.addEventListener('resize', lazyLoad);
</script>
<?php include("views/header.php"); ?>
<?php include("views/navbar.php"); ?>

<main style="display:grid;place-items:center">
    <section class="container gallery">
        <h3 class="fw-bold fs-title">Your Gallery</h3>

        <div class="image-grid">

            <?php
            $userModel = new User($conn);
            $images = $userModel->fetchImage($user_id);

            if ($images) {
                foreach ($images as $image) {
                    $filename = $image['filename'];
                    $image_title = $image['image_title']; ?>

                    <div class='image'>
                        <img src='uploads/<?php echo $filename; ?>' alt='<?php echo $image_title; ?>' loading="lazy">
                        <div class='image-overlay'>
                            <p class='image-title fw-bold'><?php echo $image_title; ?></p>
                            <div class='image-actions'>
                                <button class='btn--action'>
                                    <img src='./assets/images/share-icon.svg' alt=''>
                                </button>
                                <button class='btn--action' onclick="location.href='update.php?id=<?php echo $image['id']; ?>'"><img src='./assets/images/edit-icon.svg' alt=''></button>
                                <button class='btn--action' onclick="location.href='delete.php?id=<?php echo $image['id']; ?>'"><img src='./assets/images/delete-icon.svg' alt=''></button>
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
                echo "<div><h3 class='fw-bold fs-title'>You haven't uploaded any images yet!</h3></div>";
            }
            ?>

        </div>
    </section>
</main>
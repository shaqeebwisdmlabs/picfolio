<?php include_once("views/header.php"); ?>
<?php include("views/navbar.php"); ?>

<main style="display:grid;place-items:center">
    <section class="container gallery">
        <?php
        $imageModel = new Image($conn);
        $images = $imageModel->fetchImage($user_id);

        if (!$images->num_rows == 0) {
            include "views/image-grid.php";
        } else {
            include "views/empty-state.php";
        } ?>
    </section>
</main>

<?php include_once("views/footer.php"); ?>
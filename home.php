<?php include_once("views/header.php"); ?>
<?php include("views/navbar.php"); ?>
<?php if (!isset($_SESSION['user_id']) && !is_numeric($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
} ?>

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

<script>
    const copyToClipboard = (text) => {
        var input = document.createElement("input");
        document.body.appendChild(input);

        input.value = text;

        input.select();

        document.execCommand("copy");

        document.body.removeChild(input);

        alert("URL copied to clipboard: " + text);
    };
</script>

<?php include_once("views/footer.php"); ?>
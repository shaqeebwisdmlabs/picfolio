<?php include_once("views/header.php"); ?>
<?php include("views/navbar.php"); ?>

<?php
$userModel = new User($conn);
$imageModel = new Image($conn);
$imageController = new ImageController($userModel, $imageModel);
$images = $imageController->index();
?>

<main style="display:grid;place-items:center">
    <section class="container gallery">
        <?php
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
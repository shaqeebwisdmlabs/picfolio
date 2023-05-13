<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@800,500,700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Picfolio | Gallery</title>
</head>

<body>
    <header class="container primary-header">
        <div class="logo">
            <img src="./assets/images/logo-icon.png" alt="" height="24px" width="24px">
            <h1 class="fw-bold fs-title-sm">Picfolio</h1>
        </div>
        <div class="header-btns">
            <a href="/upload.php" class="btn btn--upload" style="text-decoration:none">
                Upload
            </a>
            <button class="btn btn--logout">
                Logout
            </button>
        </div>
    </header>
    <main style="display:grid;place-items:center">
        <section class="container gallery">
            <h3 class="fw-bold fs-title">Your Gallery</h3>
            <div class="image-grid">
                <div class="image">
                    <img src="https://source.unsplash.com/random/?city,water,modern,minimalist" alt="">
                    <div class="image-overlay">
                        <p class="image-title fw-bold">very very long image name</p>
                        <div class="image-actions">
                            <button class="btn--action">
                                <img src="./assets/images/share-icon.svg" alt="">
                            </button>
                            <button class="btn--action"><img src="./assets/images/edit-icon.svg" alt=""></button>
                            <button class="btn--action"><img src="./assets/images/delete-icon.svg" alt=""></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
</body>

</html>
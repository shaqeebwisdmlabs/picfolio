<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@800,500,700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Picfolio | Upload Image</title>
</head>

<body>

    <header class="container primary-header">
        <div class="logo">
            <img src="./assets/images/logo-icon.png" alt="" height="24px" width="24px">
            <h1 class="fw-bold fs-title-sm">Picfolio</h1>
        </div>
        <div class="header-btns">
            <a href="/home.php" style="text-decoration:none;margin-right:1em"
                class="fw-bold text-neutral-900">Gallery</a>
            <button class="btn btn--logout">
                Logout
            </button>
        </div>
    </header>
    <main style="display:grid;place-items:center">
        <section class="upload-files | bg-neutral-100 box-shadow">
            <h3 class="fw-bold fs-title">Upload Image</h3>
            <div class="upload-area">
                <div class="upload--icon">
                    <img src="./assets/images/file-icon.svg" draggable="false" />
                </div>
                <p class="fw-medium">Drag and Drop your images here</p>
                <span class="separator | fs-body-sm text-neutral-500">or</span>
                <label for="select-files" class="btn-choose">
                    Choose File
                </label>
                <input type="file" name="select-files" id="select-files" accept="image/*" hidden />
                <span class="fs-body-x-sm text-neutral-500">
                    Max file size 5MB
                </span>
            </div>
        </section>
        <div class="image-preview">
            <form action="" class="image-form">
                <h4 class="fw-bold fs-body">Image Preview</h4>
                <img src="" alt="" id="preview">
                <div class="input" style="margin-top: 3em;">
                    <label for="image-title">Image Title</label>
                    <input type="text" name="image-title" id="image-title" placeholder="Enter image title" required>
                </div>
                <button class="btn btn--submit" type="submit">Upload</button>
            </form>
        </div>
    </main>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
</body>

</html>
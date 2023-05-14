<?php include("views/header.php"); ?>
<?php include("views/navbar-upload.php"); ?>
<?php
$image_id = $_GET['id'];
$sql = "SELECT * FROM images WHERE id='$image_id'";
$result = mysqli_query($conn, $sql);
$single_image = mysqli_fetch_assoc($result);

?>

<div class="carousel">
    <button class="carousel__btn carousel__btn--left is-hidden">
        <img src="/assets/images/left-arrow.svg" alt="" />
    </button>
    <div class="carousel__track-container">
        <ul class="carousel__track">
            <li class="carousel__slide current-slide">
                <img class="carousel__image" src="uploads/<?php echo $single_image["filename"] ?>" alt="<?php echo $single_image["image_title"] ?>" loading="lazy" />
            </li>

            <?php
            $query = "SELECT * FROM images WHERE user_id ='$user_id' AND id != '$image_id'
                ";
            $images = mysqli_query($conn, $query);

            foreach ($images as $image) {
                $filename = $image['filename'];
                $image_title = $image['image_title'];
            ?>
                <li class="carousel__slide">
                    <img class="carousel__image" src='uploads/<?php echo $filename; ?>' alt='<?php echo $image_title; ?>' loading="lazy">
                </li>
            <?php }
            ?>
        </ul>
    </div>
    <button class="carousel__btn carousel__btn--right">
        <img src="/assets/images/right-arrow.svg" alt="" />
    </button>
    <div class="carousel__nav">
        <button class="carousel__indicator current-slide"></button>
        <?php
        foreach ($images as $image) { ?>

            <button class="carousel__indicator"></button>
        <?php
        } ?>

        <!-- <button class="carousel__indicator"></button>
            <button class="carousel__indicator"></button>
            <button class="carousel__indicator"></button>
            <button class="carousel__indicator"></button>
            <button class="carousel__indicator"></button>
            <button class="carousel__indicator"></button>
            <button class="carousel__indicator"></button>
            <button class="carousel__indicator"></button> -->
    </div>
</div>

<script>
    const track = document.querySelector(".carousel__track");
    const slides = Array.from(track.children);
    const nextBtn = document.querySelector(".carousel__btn--right");
    const prevBtn = document.querySelector(".carousel__btn--left");
    const navDots = document.querySelector(".carousel__nav");
    const dots = Array.from(navDots.children);

    const slideWidth = slides[0].getBoundingClientRect().width;

    // arranging the slides next to each other
    const setSlidePosition = (slide, index) => {
        slide.style.left = slideWidth * index + "px";
    };
    slides.forEach(setSlidePosition);

    // all the functions
    const moveToSlide = (track, currentSlide, targetSlide) => {
        const amountToMove = targetSlide.style.left;
        track.style.transform = "translateX(-" + amountToMove + ")";
        currentSlide.classList.remove("current-slide");
        targetSlide.classList.add("current-slide");
    };

    const updateDots = (currentDot, targetDot) => {
        currentDot.classList.remove("current-slide");
        targetDot.classList.add("current-slide");
    };

    const showHideArrows = (targetIndex, prevBtn, nextBtn, slides) => {
        if (targetIndex === 0) {
            prevBtn.classList.add("is-hidden");
            nextBtn.classList.remove("is-hidden");
        } else if (targetIndex === slides.length - 1) {
            prevBtn.classList.remove("is-hidden");
            nextBtn.classList.add("is-hidden");
        } else {
            prevBtn.classList.remove("is-hidden");
            nextBtn.classList.remove("is-hidden");
        }
    };

    // When I click left, move slide to the left
    prevBtn.addEventListener("click", () => {
        const currentSlide = track.querySelector(".current-slide");
        const prevSlide = currentSlide.previousElementSibling;
        const currentDot = navDots.querySelector(".current-slide");
        const prevDot = currentDot.previousElementSibling;
        const prevIndex = slides.findIndex((slide) => slide === prevSlide);

        // move the slide
        moveToSlide(track, currentSlide, prevSlide);
        updateDots(currentDot, prevDot);
        showHideArrows(prevIndex, prevBtn, nextBtn, slides);
    });

    // When I click right, move slide to the right
    nextBtn.addEventListener("click", () => {
        const currentSlide = track.querySelector(".current-slide");
        const nextSlide = currentSlide.nextElementSibling;
        const currentDot = navDots.querySelector(".current-slide");
        const nextDot = currentDot.nextElementSibling;
        const nextIndex = slides.findIndex((slide) => slide === nextSlide);

        // move the slide
        moveToSlide(track, currentSlide, nextSlide);
        updateDots(currentDot, nextDot);
        showHideArrows(nextIndex, prevBtn, nextBtn, slides);
    });

    // When I click nav indicator, move to that slide
    navDots.addEventListener("click", (e) => {
        // what to do when indicator is clicked on?
        const targetDot = e.target.closest("button");

        if (!targetDot) return;

        const currentSlide = track.querySelector(".current-slide");
        const currentDot = navDots.querySelector(".current-slide");
        const targetIndex = dots.findIndex((dot) => dot === targetDot);
        const targetSlide = slides[targetIndex];

        moveToSlide(track, currentSlide, targetSlide);
        updateDots(currentDot, targetDot);
        showHideArrows(targetIndex, prevBtn, nextBtn, slides);
    });
</script>


<?php include("views/footer.php"); ?>
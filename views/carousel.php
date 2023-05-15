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
    </div>
</div>
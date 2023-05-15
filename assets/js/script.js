(function ($) {
  let fileInput = null;

  $(".upload-area").on("dragover", (e) => {
    e.preventDefault();
    const element = e.target;
    if (!element.classList.contains("active")) element.classList.add("active");
  });

  $(".upload-area").on("dragleave", (e) => {
    e.preventDefault();
    const element = e.target;
    element.classList.remove("active");
  });

  $(".upload-area").on("drop", (e) => {
    e.preventDefault();
    const element = e.target;
    element.classList.remove("active");
    fileInput = e.originalEvent.dataTransfer.files[0];
    previewImage();
  });

  $("#image").on("change", (e) => {
    const fileUploaded = e.target.files[0];
    fileInput = fileUploaded;
    previewImage();
  });

  const previewImage = () => {
    let reader = new FileReader();

    if (fileInput) {
      reader.readAsDataURL(fileInput);
    }

    reader.onload = (readerEvent) => {
      if (readerEvent.target?.result) {
        console.log(readerEvent.target.result);
        document.getElementById("preview").src = reader.result;
        uploadFile(fileInput);
      }
    };
  };

  // *** Carousel ***
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
})(jQuery);

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
})(jQuery);

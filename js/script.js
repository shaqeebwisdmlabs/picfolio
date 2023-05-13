(function ($) {
  let fileInput = null;

  $(".upload-area").on("dragover", (e) => {
    console.log("drag");
    e.preventDefault();
    const element = e.target;
    if (!element.classList.contains("active")) element.classList.add("active");
  });

  $(".upload-area").on("dragleave", (e) => {
    console.log("drag leave");
    e.preventDefault();
    const element = e.target;
    element.classList.remove("active");
  });

  $(".upload-area").on("drop", (e) => {
    console.log("drop");
    e.preventDefault();
    const element = e.target;
    element.classList.remove("active");
    fileInput = e.originalEvent.dataTransfer.files;
    selectFile();
    console.log(fileInput);
  });

  $("#select-files").on("change", (e) => {
    console.log("change");
    const fileUploaded = e.target.files;
    fileInput = fileUploaded;
    selectFile();
    console.log(fileInput);
  });

  const selectFile = () => {
    let reader = new FileReader();

    if (fileInput) {
      reader.readAsDataURL(fileInput[0]);
    }

    reader.onload = (readerEvent) => {
      if (readerEvent.target?.result) {
        console.log(readerEvent.target.result);
        document.getElementById("preview").src = reader.result;
      }
    };
  };
})(jQuery);

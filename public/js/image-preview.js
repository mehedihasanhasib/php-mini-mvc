function preview(event, outputImageTagId) {
  const outImgTag = document.getElementById(outputImageTagId);

  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      outImgTag.src = e.target.result;
      outImgTag.style.display = "block";
    };
    reader.readAsDataURL(file);
  } else {
    outImgTag.src = "#";
    outImgTag.style.display = "none";
  }
}

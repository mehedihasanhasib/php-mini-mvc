const loader = document.getElementById("loader");
function submit(
  url,
  formData,
  callback = () => {
    location.reload();
  }
) {
  loader.classList.remove("d-none");

  $.ajax({
    type: "POST",
    url: url,
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      loader.classList.add("d-none");
      if (response.status) {
        Swal.fire({
          icon: "success",
          title: response.message,
        })
          .then((result) => {
            if (result.isConfirmed) {
              callback();
            }
          })
          .catch((err) => {});
      } else {
        Swal.fire({
          icon: "error",
          title: response.errors,
        });
      }
    },
    error: function (xhr) {
      loader.classList.add("d-none");
      const statusCode = xhr.status;
      const errorResponse = xhr.responseJSON?.errors;

      console.log(errorResponse);
      switch (statusCode) {
        case 500:
          notification({ icon: "error", text: errorResponse });
          break;
        case 401:
          const element = document.querySelector(".validationErrors");
          if (element) {
            element.innerText = errorResponse;
          }
          notification({ icon: "error", text: errorResponse });
          break;
        case 403:
          Swal.fire({
            icon: "error",
            title: "Unauthorize",
            text: errorResponse,
          });
          break;
        case 422:
          const allElement = document.querySelectorAll(".validationErrors");

          allElement.forEach((element) => {
            element.innerText = "";
          });

          Object.entries(errorResponse).forEach(function (errors) {
            const str = errors[0];
            const className = str.includes(".") ? str.split(".")[0] : str;
            const element = document.querySelector(`.${className}Error`);
            if (element) {
              element.innerText = errors[1];
            }
          });
          notification({ icon: "error", text: "Validation Error" });
          break;
        default:
          notification({
            icon: "error",
            text: errorResponse || "Something Went Worng!",
          });
      }
    },
  });
}

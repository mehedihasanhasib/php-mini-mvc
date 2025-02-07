const loader = document.getElementById("loader");

async function submit(url, formData, callback = () => location.reload()) {
  loader.classList.remove("d-none");

  try {
    const response = await fetch(url, {
      method: "POST",
      body: formData,
    });

    const data = await response.json();
    loader.classList.add("d-none");

    if (response.ok) {
      Swal.fire({
        icon: "success",
        title: data.message,
      }).then((result) => {
        if (result.isConfirmed) {
          callback();
        }
      });
    } else {
      handleErrors(response.status, data.errors);
    }
  } catch (error) {
    loader.classList.add("d-none");
    notification({ icon: "error", text: "Something Went Wrong!" });
  }
}

function handleErrors(statusCode, errorResponse) {
  console.log(errorResponse);

  switch (statusCode) {
    case 500:
      notification({ icon: "error", text: errorResponse });
      break;
    case 401:
      const element = document.querySelector(".validationErrors");
      if (element) element.innerText = errorResponse;
      notification({ icon: "error", text: errorResponse });
      break;
    case 403:
      Swal.fire({
        icon: "error",
        title: "Unauthorized",
        text: errorResponse,
      });
      break;
    case 422:
      document
        .querySelectorAll(".validationErrors")
        .forEach((el) => (el.innerText = ""));
      Object.entries(errorResponse).forEach(([key, value]) => {
        const className = key.includes(".") ? key.split(".")[0] : key;
        const element = document.querySelector(`.${className}Error`);
        if (element) element.innerText = value;
      });
      notification({ icon: "error", text: "Validation Error" });
      break;
    default:
      notification({
        icon: "error",
        text: errorResponse || "Something Went Wrong!",
      });
  }
}

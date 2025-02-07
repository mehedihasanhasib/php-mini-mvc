function notification({ icon, text = "Something went worng" }) {
  Swal.fire({
    icon: icon,
    // title: title,
    text: text,
    toast: true,
    position: "top-end",
    timer: 5000,
    timerProgressBar: true,
    showConfirmButton: false,
    showCloseButton: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
    customClass: {
      popup: "sweet-alert-toast-popup",
      toast: "sweet-alert-toast-popup",
      timerProgressBar: "sweet-alert-toast-progressBar",
    },
    showClass: {
      popup: "animate__animated animate__fadeInDown",
    },
    hideClass: {
      popup: "animate__animated animate__fadeOutUp",
    },
  });
}

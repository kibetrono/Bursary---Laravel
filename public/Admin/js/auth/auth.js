function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.querySelector(".password-toggle i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}


function togglePasswordConfirmVisibility() {
    var passwordInput = document.getElementById("password-confirm");
    var eyeIcon = document.querySelector(".password-toggle-confirm i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}


document.addEventListener("DOMContentLoaded", function () {
    var registerUserButton = document.getElementById("registerUserButton");
    var userRegisterForm = document.getElementById("userRegisterForm");

    userRegisterForm.addEventListener("submit", function () {
      // Disable the button on form submit
      registerUserButton.disabled = true;

      // Optionally, you can change the button's text or add a loading spinner.
      registerUserButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Creating...';
      // Alternatively, you can remove the icon if you don't want to show it anymore:
      // registerUserButton.innerText = 'Saving...';
    });
  });
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
    var updateUserButton = document.getElementById("updateUserButton");
    // Add a click event listener to the button
    updateUserButton.addEventListener("click", function () {
        // Disable the button
        updateUserButton.disabled = true;
        updateUserButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';
    });
});
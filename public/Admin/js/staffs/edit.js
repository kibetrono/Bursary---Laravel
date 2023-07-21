document.addEventListener("DOMContentLoaded", function () {
    var updateStaffButton = document.getElementById("updateStaffButton");
    // Add a click event listener to the button
    updateStaffButton.addEventListener("click", function () {
        // Disable the button
        updateStaffButton.disabled = true;
        updateStaffButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';
    });
});
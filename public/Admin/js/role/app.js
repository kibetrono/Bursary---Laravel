
// Script to allow selection of all each group permissions
window.addEventListener('DOMContentLoaded', () => {
    const groupCheckboxes = document.querySelectorAll('.group-checkbox');

    groupCheckboxes.forEach(groupCheckbox => {
        groupCheckbox.addEventListener('change', (event) => {
            const groupContainer = event.target.closest('.permissions-group');
            const permissionCheckboxes = groupContainer.querySelectorAll(
                '.permission-item input[type="checkbox"]');

            permissionCheckboxes.forEach(permissionCheckbox => {
                permissionCheckbox.checked = event.target.checked;
            });
        });
    });
});

// end of Script to allow selection of all each group permissions

// Script to allow selection of all permissions
document.addEventListener('DOMContentLoaded', function() {
    // Get the "Select All" checkbox
    const selectAllCheckbox = document.getElementById('select-all');

    // Get all the permission checkboxes
    const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

    // Add event listener to "Select All" checkbox
    selectAllCheckbox.addEventListener('change', function() {
        const isChecked = selectAllCheckbox.checked;

        // Set the state of all permission checkboxes based on "Select All" checkbox
        permissionCheckboxes.forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });
    });
});

// end of Script to allow selection of all permissions
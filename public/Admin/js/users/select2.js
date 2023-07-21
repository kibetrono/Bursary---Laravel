
$(document).ready(function() {

    // Initialize Select2
    $('#select_staff_role,#user_create_select_role,#user_edit_select_role').select2();

    // Set option selected onchange
    $('#user_selected').change(function() {
        var value = $(this).val();

        // Set selected 
        $('#select_staff_role,#user_create_select_role,#user_edit_select_role').val(value);
        $('#select_staff_role,#user_create_select_role,#user_edit_select_role').select2().trigger('change');

    });
});


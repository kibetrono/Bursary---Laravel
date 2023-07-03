$(document).ready(function() {

    // Initialize Select2
    $('#financial_year,#status').select2();

    // Set option selected onchange
    $('#user_selected').change(function() {
        var value = $(this).val();

        // Set selected 
        $('#financial_year,#status').val(value);
        $('#financial_year,#status').select2().trigger('change');

    });
});
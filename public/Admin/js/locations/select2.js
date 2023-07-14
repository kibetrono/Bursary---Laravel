$(document).ready(function () {

    // Initialize Select2
    $('#county_name,#constituency_name,#ward_name,#location_name,#sublocation_name').select2();

    // Set option selected onchange
    $('#user_selected').change(function () {
        var value = $(this).val();

        // Set selected 
        $('#county_name,#constituency_name,#ward_name,#location_name,#sublocation_name').val(value);
        $('#county_name,#constituency_name,#ward_name,#location_name,#sublocation_name').select2().trigger('change');

    });
});
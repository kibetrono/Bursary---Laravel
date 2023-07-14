$(document).ready(function () {

    // Initialize Select2
    $('#county,#constituency,#ward,#location,#sub_location,#polling_station,#bank_name,#gender,#parental_status,#fathers_employment_type,#mothers_employment_type,#guardians_employment_type,#mode_of_study').select2();

    // Set option selected onchange
    $('#user_selected').change(function () {
        var value = $(this).val();

        // Set selected 
        $('#county,#constituency,#ward,#location,#sub_location,#polling_station,#bank_name,#gender,#parental_status,#fathers_employment_type,#mothers_employment_type,#guardians_employment_type,#mode_of_study').val(value);
        $('#county,#constituency,#ward,#location,#sub_location,#polling_station,#bank_name,#gender,#parental_status,#fathers_employment_type,#mothers_employment_type,#guardians_employment_type,#mode_of_study').select2().trigger('change');

    });
});

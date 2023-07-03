$(document).ready(function () {

    // Initialize Select2
    $('#bank_name,#gender,#parental_status,#fathers_employment_type,#mothers_employment_type,#guardians_employment_type').select2();

    // Set option selected onchange
    $('#user_selected').change(function () {
        var value = $(this).val();

        // Set selected 
        $('#bank_name,#gender,#parental_status,#fathers_employment_type,#mothers_employment_type,#guardians_employment_type').val(value);
        $('#bank_name,#gender,#parental_status,#fathers_employment_type,#mothers_employment_type,#guardians_employment_type').select2().trigger('change');

    });
});


// $(document).ready(function () {

//     // Initialize Select2
//     $('#gender').select2();

//     // Set option selected onchange
//     $('#user_selected').change(function () {
//         var value = $(this).val();

//         // Set selected 
//         $('#gender').val(value);
//         $('#gender').select2().trigger('change');

//     });
// });
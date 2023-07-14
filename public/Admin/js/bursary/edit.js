$(function () {
    var $sections = $('.form-section');
    var $stepIndicator = $('.step-indicator .step');

    function navigateTo(index) {
        $sections.removeClass('current').eq(index).addClass('current');
        $stepIndicator.removeClass('active').eq(index).addClass('active');
        $('.form-navigation .previous').toggle(index > 0);
        var atTheEnd = index >= $sections.length - 1;
        $('.form-navigation .next').toggle(!atTheEnd);
        $('.form-navigation [type=submit]').toggle(atTheEnd);
    }

    function currentIndex() {
        return $sections.index($sections.filter('.current'));
    }

    $('.form-navigation .previous').click(function () {
        navigateTo(currentIndex() - 1);
    });

    $('.form-navigation .next').click(function () {
        $('.bursary-form').parsley().whenValidate({
            group: 'block-' + currentIndex()
        }).done(function () {
            navigateTo(currentIndex() + 1);
        });
    });

    $sections.each(function (index, section) {
        $(section).find(':input').attr('data-parsley-group', 'block-' + index);
    });

    navigateTo(0);
});


$(document).ready(function() {
    $(document).on('submit', '#application_form', function(e) {
    //   e.preventDefault();
  
      if ($('#application_form').parsley().isValid()) {
        $('#submitButton').prop('disabled', true).html('Saving...');
  
        // Perform your desired actions (e.g., AJAX request, form submission)
        // ...
      } else {
        $('#submitButton').prop('disabled', false);
      }
    });
  });



  $(document).ready(function() {
    $('#constituency, #ward, #location, #sub_location, #polling_station').prop('disabled', true);

    // County change event
    $('#county').change(function() {
        var countyName = $(this).val();
        // Disable dependent selects
        $('#constituency').prop('disabled', true);
        $('#ward').prop('disabled', true);
        $('#location').prop('disabled', true);
        $('#sub_location').prop('disabled', true);
        $('#polling_station').prop('disabled', true);

        // Show loading message in dependent selects
        $('#constituency').empty();
        $('#ward').empty();
        $('#location').empty();
        $('#sub_location').empty();
        $('#polling_station').empty();
        $('#ward').html('<option value="" selected disabled>Loading wards ...</option>');
        $('#location').html('<option value="" selected disabled>Loading locations ...</option>');
        $('#sub_location').html('<option value="" selected disabled>Loading sub-locations ...</option>');
        $('#polling_station').html('<option value="" selected disabled>Loading polling stations ...</option>');


        // Fetch constituencies based on the selected county
        $.get('/user-bursary/fetch-constituencies/' + countyName, function(data) {
            if (data.length > 0) {
                // Enable constituency select
                $('#constituency').prop('disabled', false);

                var options ='<option value="" selected disabled> --- Select constituency --- </option>';

                // Add the constituency options
                $.each(data, function(index, constituency) {
                    options += '<option value="' + constituency.name + '">' +
                        constituency.name + '</option>';
                });

                // Set the HTML of the select
                $('#constituency').html(options);

            }
            else{
                $('#constituency').append('<option value="">No constituency found</option>');
            }
        });
    });

    // Constituency change event
    $('#constituency').change(function() {
        var constituencyName = $(this).val();
        // Disable dependent selects
        $('#ward').prop('disabled', true);
        $('#location').prop('disabled', true);
        $('#sub_location').prop('disabled', true);
        $('#polling_station').prop('disabled', true);

        $('#ward').empty();
        $('#location').empty();
        $('#sub_location').empty();
        $('#polling_station').empty();
        $('#location').html('<option value="" selected disabled>Loading locations ...</option>');
        $('#sub_location').html('<option value="" selected disabled>Loading sub-locations ...</option>');
        $('#polling_station').html('<option value="" selected disabled>Loading polling stations ...</option>');


        // Fetch wards based on the selected constituency
        $.get('/user-bursary/fetch-wards/' + constituencyName, function(data) {
            if (data.length > 0) {
                // Enable ward select
                $('#ward').prop('disabled', false);

                var options ='<option value="" selected disabled> --- Select ward --- </option>';

                // Add the constituency options
                $.each(data, function(index, ward) {
                    options += '<option value="' + ward.name + '">' +
                        ward.name + '</option>';
                });

                // Set the HTML of the select
                $('#ward').html(options);

            }
            else{
                $('#ward').append('<option value="">No ward found</option>');
            }
        });
    });

    // Ward change event
    $('#ward').change(function() {
        var wardName = $(this).val();
        // Disable dependent selects
        $('#location').prop('disabled', true);
        $('#sub_location').prop('disabled', true);
        $('#polling_station').prop('disabled', true);

        $('#location').empty();
        $('#sub_location').empty();
        $('#polling_station').empty();
        $('#sub_location').html('<option value="" selected disabled>Loading sub-locations ...</option>');
        $('#polling_station').html('<option value="" selected disabled>Loading polling stations ...</option>');


        // Fetch locations based on the selected ward
        $.get('/user-bursary/fetch-locations/' + wardName, function(data) {
            if (data.length > 0) {
                // Enable location select
                $('#location').prop('disabled', false);

                var options ='<option value="" selected disabled> --- Select location --- </option>';

                // Add the constituency options
                $.each(data, function(index, location) {
                    options += '<option value="' + location.name + '">' +
                        location.name + '</option>';
                });

                // Set the HTML of the select
                $('#location').html(options);

            }
            else{
                $('#location').append('<option value="">No location found</option>');
            }
        });
    });

    // Location change event
    $('#location').change(function() {
        var locationName = $(this).val();
        // Disable dependent selects
        $('#sub_location').prop('disabled', true);
        $('#polling_station').prop('disabled', true);

        $('#sub_location').empty();
        $('#polling_station').empty();
        $('#polling_station').html('<option value="" selected disabled>Loading polling stations ...</option>');


        // Fetch sub-locations based on the selected location
        $.get('/user-bursary/fetch-sub-locations/' + locationName, function(data) {
            if (data.length > 0) {
                // Enable sub-location select
                $('#sub_location').prop('disabled', false);

                var options ='<option value="" selected disabled>  --- Select sub-location  --- </option>';

                // Add the constituency options
                $.each(data, function(index, subLocation) {
                    options += '<option value="' + subLocation.name + '">' +
                        subLocation.name + '</option>';
                });

                // Set the HTML of the select
                $('#sub_location').html(options);

            }
            else{
                $('#sub_location').append('<option value="">No sub-location found</option>');
            }
        });
    });

    // Sub-location change event
    $('#sub_location').change(function() {
        var subLocationName = $(this).val();
        // Disable polling station select
        $('#polling_station').prop('disabled', true);

        // Clear polling station select
        $('#polling_station').empty();

        // Fetch polling stations based on the selected sub-location
        $.get('/user-bursary/fetch-polling-stations/' + subLocationName, function(data) {
            if (data.length > 0) {
                // Enable polling station select
                $('#polling_station').prop('disabled', false);

                var options ='<option value="" selected disabled>  --- Select polling station  --- </option>';

                // Add the constituency options
                $.each(data, function(index, pollingStation) {
                    options += '<option value="' + pollingStation.name + '">' +
                        pollingStation.name + '</option>';
                });

                // Set the HTML of the select
                $('#polling_station').html(options);

            }
            else{
                $('#polling_station').append('<option value="">No polling station found</option>');
            }
        });
    });
});
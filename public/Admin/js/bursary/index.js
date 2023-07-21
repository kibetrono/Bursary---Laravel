$(document).ready(function () {

     // Event listener for "Select All" checkbox change
     $('#select-all-checkbox').change(function () {
        var isChecked = $(this).is(':checked');
        $('input[name="selected_bursaries[]"]').prop('checked', isChecked);
    });

    var table = $('#users-table').DataTable({
        paging: false,
        info: false,
        searching: true,
        ordering: true,
        select: true,
    });

    // Create the select element
    var selectElement = document.createElement('select');
    selectElement.setAttribute('class', 'form-control');
    selectElement.setAttribute('id', 'bulk-action-selector-top');
    selectElement.setAttribute('name', 'action');

    var options = [
        { value: '', text: 'Bulk actions' }
    ];

    if (hasApprovePermission) {
        // options.push({ value: 'approve', text: 'Approve' });
        options.push({ value: 'approve', text: 'Approve' });
    }

    if (hasRejectPermission) {
        options.push({ value: 'reject', text: 'Reject' });
    }

    // Add the options to the select element
    options.forEach(function (option) {
        var optionElement = document.createElement('option');
        optionElement.setAttribute('value', option.value);
        optionElement.setAttribute('id', 'approve_option_id');
        optionElement.textContent = option.text;
        selectElement.appendChild(optionElement);
    });

    // Create the "Apply" button
    var applyButton = document.createElement('input');
    applyButton.setAttribute('type', 'submit');
    applyButton.setAttribute('class', 'button action');
    applyButton.setAttribute('id', 'doaction');
    applyButton.setAttribute('value', 'Apply');

    // Create a div to wrap the select element and apply button
    var wrapperDiv = document.createElement('div');
    wrapperDiv.setAttribute('class', 'alignleft');

    // Append the select element and apply button to the wrapper div
    wrapperDiv.appendChild(selectElement);
    wrapperDiv.appendChild(applyButton);

    // Append the wrapper div to the users-table_wrapper div
    var wrapper = document.querySelector('#users-table_wrapper');
    wrapper.insertBefore(wrapperDiv, wrapper.firstChild);
    // Event listener for the "Apply" button click
    applyButton.addEventListener('click', function () {
        var selectedOption = selectElement.value;
        var selectedCheckboxes = $('input[name="selected_bursaries[]"]:checked');

        if (selectedOption != '') {
            // alert(selectedOption)
            if (selectedCheckboxes.length > 0) {
                var selectedIds = selectedCheckboxes.map(function () {
                    return $(this).val();
                }).get();
                if (selectedOption == 'approve') {
                    if (confirm("Are you sure you want to approve all the selected applications?")) {
                        let alloptions = selectElement.getElementsByTagName('option');
                        $('#loadingMessageBursaryPage').show();
                        $('#doaction').prop('disabled', true);                       
                        for (let i = 0; i < alloptions.length; i++) {
                            if (alloptions[i].id === 'approve_option_id') {
                              alloptions[i].style.display = 'none';
                            }
                          }
                          
                        // Perform your AJAX request here
                        $.ajax({
                            url: bulkActionRoute,
                            method: 'POST', // Set the request method to POST
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                            data: {
                                action: selectedOption,
                                ids: selectedIds
                            },
                            success: function (response) {
                                // Handle the success response
                                $('#loadingMessageBursaryPage').hide();
                                $('#doaction').prop('disabled', false);                       
                                
                                for (let i = 0; i < alloptions.length; i++) {
                                    if (alloptions[i].id === 'approve_option_id') {
                                      alloptions[i].style.display = 'block';
                                    }
                                  }
                                window.location.href = response.url;
                            },
                            error: function (xhr) {
                                $('#loadingMessageBursaryPage').hide();
                                $('#doaction').prop('disabled', false);                       
                                
                                for (let i = 0; i < alloptions.length; i++) {
                                    if (alloptions[i].id === 'approve_option_id') {
                                      alloptions[i].style.display = 'block';
                                    }
                                  }
                                // Handle the error response
                            }
                        });
                    } else {
                        $('#bulk-action-selector-top').val(''); // Reset the select option to default value
                        return false; // Abort the AJAX request
                    }
                } else if (selectedOption == 'reject') {
                    if (confirm("Are you sure you want to reject all the selected applications?")) {
                        let alloptions = selectElement.getElementsByTagName('option');

                        $('#loadingMessageBursaryPage').show();
                        $('#doaction').prop('disabled', true);                       

                        for (let i = 0; i < alloptions.length; i++) {
                            if (alloptions[i].id === 'approve_option_id') {
                              alloptions[i].style.display = 'none';
                            }
                          }
                        // Perform your AJAX request here
                        $.ajax({
                            url: bulkActionRoute,
                            method: 'POST', // Set the request method to POST
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                            data: {
                                action: selectedOption,
                                ids: selectedIds
                            },
                            success: function (response) {
                                // Handle the success response
                                $('#loadingMessageBursaryPage').show();
                                $('#doaction').prop('disabled', false);                       

                        for (let i = 0; i < alloptions.length; i++) {
                            if (alloptions[i].id === 'approve_option_id') {
                              alloptions[i].style.display = 'block';
                            }
                          }
                                window.location.href = response.url;
                            },
                            error: function (xhr) {
                                $('#loadingMessageBursaryPage').show();
                                $('#doaction').prop('disabled', false);                       

                        for (let i = 0; i < alloptions.length; i++) {
                            if (alloptions[i].id === 'approve_option_id') {
                              alloptions[i].style.display = 'block';
                            }
                          }
                                // Handle the error response
                            }
                        });
                    } else {
                        $('#bulk-action-selector-top').val(''); // Reset the select option to default value
                        return false; // Abort the AJAX request
                    }
                }

            } else {
                // No checkboxes selected, handle the error or display a message
                alert('No applications selected to approve or reject.')
                $('#bulk-action-selector-top').val(''); // Reset the select option to default value
                return false; // Abort the AJAX request
            }
        } else {
            alert('No action selected.')
            $('#bulk-action-selector-top').val(''); // Reset the select option to default value
            return false; // Abort the AJAX request
        }
    });

});


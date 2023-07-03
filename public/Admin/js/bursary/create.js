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
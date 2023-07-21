// Script to handle the custom-setting navigation and scroll functionality

// When the DOM is loaded, execute the following function
document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('#custom-setting-sidenav a.list-group-item');
    const sections = document.querySelectorAll('.card[id^="custom-setting"]');
    let previousActiveSection = null;
    let previousActiveNavLink = null;

    const observerOptions = {
        root: null,
        threshold: 0.5
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                if (previousActiveSection && previousActiveSection !== entry.target) {
                    previousActiveSection.classList.remove('myActiveSection');
                    if (previousActiveNavLink) {
                        previousActiveNavLink.classList.remove('active');
                    }
                }

                entry.target.classList.add('myActiveSection');
                const targetNavLink = document.querySelector(
                    `a[href="#${entry.target.id}"]`);
                if (targetNavLink) {
                    targetNavLink.classList.add('active');
                    previousActiveNavLink = targetNavLink;
                }

                previousActiveSection = entry.target;
            }
        });
    }, observerOptions);

    sections.forEach(function (section) {
        observer.observe(section);
    });

    navLinks.forEach(function (navLink) {
        navLink.addEventListener('click', function () {
            const target = this.getAttribute('href');
            const targetSection = document.querySelector(target);

            navLinks.forEach(function (link) {
                link.classList.remove('active');
            });

            this.classList.add('active');
            previousActiveNavLink = this;

            sections.forEach(function (section) {
                section.classList.remove('myActiveSection');
            });

            targetSection.classList.add('myActiveSection');

            // Calculate the offset for the fixed header, if any
            const headerOffset = 60;
            const targetSectionTop = targetSection.getBoundingClientRect().top;
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            // Use scrollIntoView() directly on the target section with adjusted scroll position
            window.scrollTo({
                top: scrollPosition + targetSectionTop - headerOffset,
                behavior: 'smooth',
            });
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('sendTestEmailBtn').addEventListener('click', function () {
        var subject = document.getElementById('testEmailSubject').value;
        var body = document.getElementById('testEmailBody').value;
        if (subject.trim() === '' || body.trim() === '') {
            alert('Please enter both subject and body.');
            return;
        } else {
            // Show the loading spinner
            $('#loadingMessage').show();
            $('#sendTestEmailBtn').prop('disabled', true);

            $.ajax({
                url: sendtestemailurl,
                type: 'POST',
                data: {
                    subject: subject,
                    body: body
                },

                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request header
                },
                success: function (response) {
                    // Hide the loading spinner
                    $('#loadingMessage').hide();
                    $('#sendTestEmailBtn').prop('disabled', false);

                    alert(response.success);
                    $('#testEmailModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    // Hide the loading spinner
                    $('#loadingMessage').hide();
                    $('#sendTestEmailBtn').prop('disabled', false);

                    var response = xhr.responseJSON; // Parse the JSON response

                    // Check if smtp_error exists in the response
                    if (response.smtp_error) {
                        // Use the smtp_error in your preferred way.
                        // For example, you can display it in an alert or show it on your page.
                        alert(response.smtp_error);
                        $('#testEmailModal').modal('hide');

                    } else {
                        // Handle other errors
                        alert(response.message);
                        $('#testEmailModal').modal('hide');

                    }

                }
            });
        }
    });
});
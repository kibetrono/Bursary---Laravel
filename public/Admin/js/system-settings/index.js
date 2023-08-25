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
    var emailInput = document.getElementById('testEmailAddress');
    var sendTestEmailBtn = document.getElementById('sendTestEmailBtn');
    var loadingMessage = $('#loadingMessage');

    sendTestEmailBtn.addEventListener('click', function () {
        var email_address_input = emailInput.value.trim();
        if (email_address_input === '') {
            emailInput.style.border = "1px solid red";
            return;
        } else {
            emailInput.style.border = "1px solid #ced4da"; // Set the border color to default

            // Show the loading spinner
            loadingMessage.show();
            sendTestEmailBtn.disabled = true;

            $.ajax({
                url: sendtestemailurl,
                type: 'POST',
                data: {
                    email_address: email_address_input,
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    // Hide the loading spinner
                    loadingMessage.hide();
                    sendTestEmailBtn.disabled = false;

                    $('#testEmailModal').modal('hide');
                    window.location.href = response.url;
                },
                error: function (xhr, status, error) {
                    // Hide the loading spinner
                    loadingMessage.hide();
                    sendTestEmailBtn.disabled = false;

                    var response = xhr.responseJSON;
                    if (response.smtp_error) {
                        $('#testEmailModal').modal('hide');
                        window.location.href = response.url;
                    } else {
                        $('#testEmailModal').modal('hide');
                    }
                }
            });
        }
    });

    // Add an input event listener to reset the border color when typing starts
    emailInput.addEventListener('input', function () {
        emailInput.style.border = "1px solid #ced4da"; // Reset the border color to default
    });
});

// changing logo and favicon

function handleImagePreview(inputId, previewId) {
    document.getElementById(inputId).addEventListener('change', function () {
        var preview = document.getElementById(previewId);
        var file = this.files[0];

        if (file) {
            preview.src = window.URL.createObjectURL(file);
        } else {
            preview.src = ''; // Clear the preview if no file selected
        }
    });
}

handleImagePreview('full_logo', 'logo_preview');
handleImagePreview('favicon', 'favicon_preview');

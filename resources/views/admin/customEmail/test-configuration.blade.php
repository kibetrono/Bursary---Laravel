@php
    // Get the current hour in 24-hour format
    $currentHour = (int) date('G');
    // Initialize the greeting variable
    $greeting = '';
    
    // Determine the appropriate greeting based on the time of day
    if ($currentHour >= 5 && $currentHour < 12) {
        $greeting = 'Good morning';
    } elseif ($currentHour >= 12 && $currentHour < 18) {
        $greeting = 'Good afternoon';
    } else {
        $greeting = 'Good evening';
    }
@endphp

@component('mail::message')
    # SMTP Configuration Test Successful

    {{ $greeting }},

    This is a test email to confirm that SMTP configurations have been set up correctly. Congratulations! Email settings are now functional, and you should be able to send and receive emails using your preferred email service.

    Below are some details about your SMTP configurations:

    - **SMTP Host:** {{ $host }}
    - **SMTP Port:** {{ $port }}
    - **Encryption Method:** {{ $encryption }}
    - **SMTP Username:** {{ $username }}
    - **SMTP Password:** {{ $pwd }}

    If you encounter any issues with your email setup in the future, please review these settings or contact your email service provider for assistance.

    If you have any further questions or need additional support, feel free to reach out to our customer support team, and we'll be more than happy to help.

    Thank you for choosing our service!

    Sincerely,
    The {{ config('app.name') }} Team

    @component('mail::button', ['url' => $url])
        Click Here to navigate back
    @endcomponent
    
@endcomponent

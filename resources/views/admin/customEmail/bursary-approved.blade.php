@component('mail::message')

    Congratulations {{ $user->name }},

    Congratulations, your bursary application for academic year {{ $year }} has been approved. {{ $institution }}
    will receive your funds.

    Next Steps:
    1. {{ $institution }} will contact you to provide further instructions on the disbursement process.
    2. Make sure to review and comply with any requirements or documents requested by {{ $institution }} to receive the
    bursary funds.
    3. Should you have any questions or concerns, please reach out to {{ $institution }}'s bursary department.

    Note:
    Once again, congratulations on your successful application. We wish you all the best in your academic endeavors.

    Best regards,
    The {{ config('app.name') }} Team

@endcomponent



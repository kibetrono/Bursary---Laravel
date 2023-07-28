@component('mail::message')
    Hello {{ $user->name }},

    We sincerely regret to inform you that your bursary application for the academic year {{ $year }} was not successful. After careful evaluation, it was determined that your application did not meet all the necessary requirements for consideration.

    Please be aware that the selection process is highly competitive, and we receive numerous applications each year. Although your application was not successful this time, we encourage you to try again in the future and explore other available opportunities for financial aid.

    Thank you for your interest in our bursary program, and we appreciate the effort you put into your application. We wish you the best in your academic pursuits and hope that you find success in your educational journey.

    Best regards,
    The {{ config('app.name') }} Team

@endcomponent

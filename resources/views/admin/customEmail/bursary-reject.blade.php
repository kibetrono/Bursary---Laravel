@component('mail::message')
    <p>Hello {{ $user->name }},</p>
    <p> We regret that your bursary application for academic year {{ $year }} was unsuccessful as you did not meet all the requirements needed.</p>
@endcomponent

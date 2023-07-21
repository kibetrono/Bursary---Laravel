@component('mail::message')
    <p>Congratulations {{ $user->name }}</p>
    <p>Congratulations, your bursary application for academic year {{ $year }} has been approved.
        {{ $institution }} will receive your funds.</p>
@endcomponent

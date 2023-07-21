@component('mail::message')
    <p>Congratulations {{ $user->name }}</p>
    <p>Congratulations, you have successfully applied the bursary application for year academic year {{ $year }}. Kindly wait us we check your application.</p>
@endcomponent

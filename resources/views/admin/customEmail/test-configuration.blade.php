@component('mail::message')
    <p>{{ $body }} </p>
    @component('mail::button', ['url'=>$url])
        Click Here to navigate back
    @endcomponent
@endcomponent

@component('mail::message')
    Welcome {{ $name }}
    @component('mail::button', ['url'=>'https://bursary.dev.softwareske.net/'])
        Click Here to login
    @endcomponent
@endcomponent

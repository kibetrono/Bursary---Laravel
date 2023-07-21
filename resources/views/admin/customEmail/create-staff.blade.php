@component('mail::message')
    <p>Welcome {{ $name }},</p>
    <p>Congratulations.You have been assigned a {{$role->name}} role. Kindly adhere to all the rules required as a {{$role->name}}</p>
@endcomponent

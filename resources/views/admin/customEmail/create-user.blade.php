@component('mail::message')
    <p>Hi {{ $name }},</p>
    <p>Welcome to our department.You have been assigned a {{$role->name}} role. Kindly adhere to all the rules required as a {{$role->name}}</p>
@endcomponent

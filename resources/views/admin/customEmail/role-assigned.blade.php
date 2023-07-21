@component('mail::message')
    <p>Congratulations {{ $name }}</p>
    <p>You have successfully been assigned a {{ $role->name }} role. Kindly adhere to all the rules required as
        {{ $role->name }}</p>
@endcomponent

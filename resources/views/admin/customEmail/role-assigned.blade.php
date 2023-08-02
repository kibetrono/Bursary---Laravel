@php
    // Get the current hour in 24-hour format
    $currentHour = (int) date('G');
    // Initialize the greeting variable
    $greeting = '';
    
    // Determine the appropriate greeting based on the time of day
    if ($currentHour >= 5 && $currentHour < 12) {
        $greeting = 'Good morning';
    } elseif ($currentHour >= 12 && $currentHour < 18) {
        $greeting = 'Good afternoon';
    } else {
        $greeting = 'Good evening';
    }
@endphp

@component('mail::message')
    {{-- Email Subject --}}

    {{ $greeting }} {{ $name }},

    {{-- Email Body --}}
    Congratulations.You have been assigned the role of "{{ $role->name }}". We are excited to have you on board!

    Here are some details about your new role:

    - Role Name: {{ $role->name }}
    - Permissions: 
    @forelse ($role->permissions as $permission)
        - {{ ucfirst($permission->name) }}
    @empty
        <p class="fas fa-folder-open" style="font-weight: normal"> No
            Permission(s) Found</p>
    @endforelse

    Best regards,
    The {{ config('app.name') }} Team

@endcomponent

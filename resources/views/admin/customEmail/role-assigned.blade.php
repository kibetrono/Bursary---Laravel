@component('mail::message')
    {{-- Email Subject --}}
    # Congratulations, {{ $name }}!

    {{-- Email Body --}}
    You have been assigned the role of "{{ $role->name }}". We are excited to have you on board!

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

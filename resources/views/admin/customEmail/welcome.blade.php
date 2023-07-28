@component('mail::message')
    {{-- Greeting --}}
    <h3>Hello, {{ $user->name }}</h3>
    Welcome to our website. Thank you for signing up!

    {{-- Additional Information --}}
    We are thrilled to have you as part of our community. Here are some important details about your account:

    - Email Address: {{ $user->email }}
    - Account Creation Date: {{ $user->created_at->format('M d, Y') }}

    {{-- Note --}}
    Get started by logging into your account and exploring all the exciting features we have to offer. If you have any
    questions or need assistance, feel free to reach out to our support team at info@softwareske.com .

    {{-- Signature --}}
    Best regards,
    The {{ config('app.name') }} Team
@endcomponent

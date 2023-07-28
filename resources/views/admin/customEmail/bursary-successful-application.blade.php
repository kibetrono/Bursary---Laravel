
@component('mail::message')
    {{-- Greeting --}}
    Congratulations {{ $user->name }},
    
    {{-- Bursary Application Confirmation --}}
    Congratulations, you have successfully applied for the bursary for the academic year {{ $year }}. We appreciate your interest in our bursary program.

    {{-- Application Review --}}
    Our team is currently reviewing your application. We carefully consider each application, and it may take some time to evaluate all the candidates.

    {{-- Next Steps --}}
    In the meantime, here are the next steps in the application process:
    
    Please ensure that all the required documents are complete and accurate. Any missing or incorrect information may delay the review process.
    We will contact you via email if any additional information or documents are needed.
    Once the review process is completed, you will be notified of the outcome via email.

    {{-- Note --}}
    If you have any questions regarding your application or need further assistance, don't hesitate to reach out to visit our offices.

    {{-- Signature --}}
    Best regards,
    The {{ config('app.name') }} Team

@endcomponent

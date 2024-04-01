@component('mail::layout')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
    @endcomponent
@endslot

{{-- Body --}}
# Welcome to Our Newsletter

Hello {{ $user->name }},

Welcome to our newsletter! We're excited to have you as a subscriber.

Here's what you can expect from us:
- Exciting updates about our platform
- Informative blog posts and articles
- Exclusive offers and promotions

We hope you enjoy our newsletter. If you have any questions or feedback, feel free to reply to this email.

Thank you for joining us!

Best regards,<br>
The {{ config('app.name') }} Team

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        You're receiving this email because you signed up for our newsletter.
    @endcomponent
@endslot
@endcomponent

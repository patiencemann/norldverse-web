@component('mail::message')
    # Welcome to {{ config('app.name') }}

    Hi {{ $user->name }},

    Welcome aboard! 🚀
    We're thrilled to have you as part of our community of reader & bloggers.

    To get started on our platform, you can explore interesting articles, insights, and perspectives from other bloggers,
    and also engage with fellow bloggers, leave comments, and build meaningful connections within our community.

    We're here to support you every step of the way. If you have any questions or need assistance, don't hesitate to reach
    out to us at hseal419@gmail.com.

    Happy reading & blogging!

    Best regards,<br>
    The {{ config('app.name') }} Team
@endcomponent

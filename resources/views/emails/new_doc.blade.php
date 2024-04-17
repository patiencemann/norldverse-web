@component('mail::message')
    # {{ $doc->title }}

    ![{{ $doc->title }}]({{ $doc->docMedia->file_url }})

    {{ $doc->caption }}

    [Read More]({{ env('APP_URL') }}/docs/{{ $doc->slug }})

    Thanks,
    The {{ config('app.name') }} Team
@endcomponent

@component('mail::message')
    # {{ $data->title }}

    ![{{ $data->title }}]({{ $data->docMedia->file_url }} "{{ $data->title }}")

    {{ $data->caption }}

    [Read More]({{ env('APP_URL') }}/docs/{{ $data->slug }})

    Thanks,
    {{ config('app.name') }}
@endcomponent

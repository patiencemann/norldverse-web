@component('mail::message')
# {{ $data->title }}

@component('mail::image', ['url' => $data->docMedia->file_url, 'alt' => $data->title ])
@endcomponent

{{ $data->caption }}

@component('mail::button', ['url' => env('APP_URL').'/docs/'.$data->slug ])
Read More
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

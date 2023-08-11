<!DOCTYPE html>
<html>
<head>
    <title>{{ $data->title }}</title>
</head>
<body>
    <h1>{{ $data->title }}</h1>
    <p>{{ $data->caption }}</p>
    <a href="{{ env('APP_URL').'/docs/'.$data->slug }}">Read More</a>
</body>
</html>

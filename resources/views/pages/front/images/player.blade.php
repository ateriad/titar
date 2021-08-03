<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <title>{{ $image->title }} - {{ trans(config('app.name')) }}</title>
    <link rel="stylesheet" href="{{ asset('css/front/videos/show.css') }}">
</head>
<body style="margin: 0; background: black;">
<script src="{{ asset('vendor/panolens/three.min.js') }}"></script>
<script src="{{ asset('vendor/panolens/panolens.min.js') }}"></script>
<script>
    const panorama = new PANOLENS.ImagePanorama( '{{ $image->attribute('url') }}' );
    const viewer = new PANOLENS.Viewer();
    viewer.add( panorama );
</script>
</body>
</html>

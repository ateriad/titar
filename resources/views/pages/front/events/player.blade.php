<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <title>{{ $event->title }} - {{ trans(config('app.name')) }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/video-js-7.7.5/video-js.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/videojs-vr-1.7.2/videojs-vr.css') }}">
</head>
<body style="margin: 0; background: black;">

<video id="player" controls preload="auto" poster="{{ $event->attribute('banner') }}" class="video-js vjs-16-9 vjs-default-skin">
    <source src="{{ $event->attribute('url') }}" type="{{ $type }}">
    <p>مرورگر شما نمایش ویدیو ها را مسدود کرده است.</p>
</video>

<script src="{{ asset('vendor/hls.js') }}"></script>
<script src="{{ asset('vendor/video-js-7.7.5/video.min.js') }}"></script>
<script src="{{ asset('vendor/videojs-vr-1.7.2/videojs-vr.min.js') }}"></script>
<script>
    let player = videojs('player', {
        controls: true,
        autoplay: false,
        fluid: true,
        preload: 'auto'
    });

    player.mediainfo = player.mediainfo || {};
    player.mediainfo.projection = '360';
    player.vr({projection: 'AUTO', debug: true, forceCardboard: false});
    player.requestFullscreen();

    let video = document.getElementsByTagName('video')[0];
    video.setAttribute('crossorigin', 'https://titar.ir');

    if (Hls.isSupported()) {
        let hls = new Hls();
        hls.loadSource('{{ $event->attribute('url') }}');
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED, function () {
            ///video.play();
        });
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        video.src = '{{ $event->attribute('url') }}';
        video.addEventListener('loadedmetadata', function () {
            //video.play();
        });
    }
</script>

</body>
</html>

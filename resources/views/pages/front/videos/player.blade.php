<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <title>{{ $video->title }} - {{ trans(config('app.name')) }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/video-js-7.7.5/video-js.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/videojs-vr-1.7.2/videojs-vr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/front/videos/show.css') }}">
</head>
<body style="margin: 0; background: black;">
@if($advertisement !== null)
    <video id="advertisement" controls preload="auto"
           poster="{{ $video->attribute('banner') }}" class="video-js vjs-16-9 vjs-default-skin">
        <source src="{{ $advertisement->video }}" type="video/mp4">
    </video>
    <div id="buttons">
        <a href="{{ $advertisement->url }}" target="_blank">
            <button id="url" style="border: none;border-radius: 0;padding: 10px 15px;background: #6691a1;color: #fff;font-family: IRANSans !important;" class="button">اطلاعات بیشتر</button>
        </a>
        <button style="border: none;border-radius: 0;padding: 10px 15px;background: #6691a1;color: #fff;font-family: IRANSans !important;" id="skip" class="button" onclick="skipAd()">ردکردن تبلیغ</button>
    </div>
@endif
<video {{ $advertisement !== null ? 'style=display:none' : '' }} id="player" controls preload="auto"
       poster="{{ $video->attribute('banner') }}" class="video-js vjs-16-9 vjs-default-skin">
    <source src="{{ $video->attribute('url') }}" type="{{ $type }}">
    <p>مرورگر شما نمایش ویدیو ها را مسدود کرده است.</p>
</video>

<script src="{{ asset('vendor/hls.js') }}"></script>
<script src="{{ asset('vendor/video-js-7.7.5/video.min.js') }}"></script>
<script src="{{ asset('vendor/videojs-vr-1.7.2/videojs-vr.min.js') }}"></script>
<script>
    let ad = document.getElementById("advertisement");
    if (ad !== null) {
        ad.onended = function () {
            skipAd();
        };
    }
    let adv = {!! json_encode($advertisement) !!} ;
    if (adv == null) {
        skipAd();
    }

    let advertisement = videojs('advertisement', {
        controls: false,
        autoplay: true,
        fluid: true,
        preload: 'auto'
    });

    advertisement.mediainfo = advertisement.mediainfo || {};
    advertisement.mediainfo.projection = '360';
    advertisement.vr({projection: 'AUTO', debug: true, forceCardboard: false});
    advertisement.requestFullscreen();

    let videoAdvertisement = document.getElementById('advertisement');
    videoAdvertisement.setAttribute('crossorigin', 'https://titar.ir');

    if (Hls.isSupported()) {
        let hls = new Hls();
        hls.loadSource('{{ $advertisement->video }}');
        hls.attachMedia(videoAdvertisement);
        hls.on(Hls.Events.MANIFEST_PARSED, function () {
            ///video.play();
        });
    } else if (videoAdvertisement.canPlayType('application/vnd.apple.mpegurl')) {
        videoAdvertisement.src = '{{ $advertisement->video }}';
        videoAdvertisement.addEventListener('loadedmetadata', function () {
            //video.play();
        });
    }

    if (adv.skippable == 2) {
        document.getElementById('skip').style.display = 'none';
        setTimeout(function () {
            document.getElementById('skip').style.display = 'block';
        }, adv.length * 1000);
    }

    function skipAd() {
        if (adv !== null) {
            document.getElementById('buttons').remove();
            document.getElementById('advertisement').remove();
        }
        document.getElementById('player').style.display = 'block';
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

        let video = document.getElementById('player');
        video.setAttribute('crossorigin', 'https://titar.ir');

        if (Hls.isSupported()) {
            let hls = new Hls();
            hls.loadSource('{{ $video->attribute('url') }}');
            hls.attachMedia(video);
            hls.on(Hls.Events.MANIFEST_PARSED, function () {
                ///video.play();
            });
        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            video.src = '{{ $video->attribute('url') }}';
            video.addEventListener('loadedmetadata', function () {
                //video.play();
            });
        }
    }
</script>
</body>
</html>

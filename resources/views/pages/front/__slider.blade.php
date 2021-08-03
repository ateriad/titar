<section id="slider">
    <div id="full-slider-wrapper">
        <div id="layerslider" style="width:100%;height:500px;">
            @foreach($slides as $slide)
                <div class="ls-slide" >
                    <img src="{{ asset($slide->image) }}" class="ls-bg" alt="titar"/>
                    <h3 class="ls-l">{{ $slide->title }}</h3>
                    <p class="ls-l">{{ $slide->description }}</p>
                    <a href="{{ $slide->link }}" class="ls-l button">{{ $slide->button }}</a>
                </div>
            @endforeach
        </div>
    </div>
</section>

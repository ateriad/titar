<div class="off-canvas position-left light-off-menu" id="offCanvas-responsive" data-off-canvas>
    <div class="off-menu-close">
        <h3>تیتار</h3>
        <span data-toggle="offCanvas-responsive"><i class="fa fa-times"></i></span>
    </div>
    <ul class="vertical menu off-menu" data-responsive-menu="drilldown">
        <li class="has-submenu" data-dropdown-menu="example1">
            <a>ویدئو ها</a>
            <ul class="submenu menu vertical" data-submenu
                data-animate="slide-in-down slide-out-up">
                @foreach($rootVideoCategories as $c)
                    <li>
                        <a>{{ $c->title }}</a>
                        @if($c->children()->count() !== 0)
                            <ul class="submenu menu vertical" data-submenu
                                data-animate="slide-out-down slide-in-up">
                                @foreach($c->children as $child)
                                    <li>
                                        <a href="{{route('videos.categories.show' , ['category' => $child->id])}}">{{$child->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                <li><a href="{{ route('videos.categories.show', 0) }}">همه</a></li>
            </ul>
        </li>
        <li>
            <a>رویداد ها</a>
            <ul class="submenu menu vertical" data-submenu
                data-animate="slide-in-down slide-out-up">
                @foreach($rootEventCategories as $c)
                    <li>
                        <a>{{ $c->title }}</a>
                        @if($c->children()->count() !== 0)
                            <ul class="submenu menu vertical" data-submenu
                                data-animate="slide-out-down slide-in-up">
                                @foreach($c->children as $child)
                                    <li>
                                        <a href="{{route('videos.categories.show' , ['category' => $child->id])}}">{{$child->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                <li><a href="{{ route('events.categories.show', 0) }}">همه</a></li>
            </ul>
        </li>
        <li><a href="{{ route('about.show') }}">درباره ما</a></li>
        <li><a href="{{ route('contact.show') }}">تماس با ما</a></li>
    </ul>
    <div class="top-button">
        <ul class="menu">
            <li>
                <a href="submit-post.html">آپلود ویدئو</a>
            </li>
            <li class="dropdown-login">
                <a href="login.html">ورود/ثبت نام</a>
            </li>
        </ul>
    </div>
</div>

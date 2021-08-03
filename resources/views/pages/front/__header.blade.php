<header>
    <section id="top" class="topBar show-for-large">
        <div class="row">
            <div class="medium-6 columns">
                <div class="top-button">
                    <ul class="menu float-right">
                        <li>
{{--
                            <a href="#">آپلود ویدئو</a>
--}}
                        </li>
                        <li class="dropdown-login">
                            @if(auth()->user() != null)
                                <a href="{{ route('account.profile') }}">حساب کاربری</a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}">مدیریت</a>
                                @endif
                            @else
                                <a class="loginReg" data-toggle="example-dropdown" href="{{ route('auth.otp.show') }}">ورود/ثبت نام</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <div class="medium-6 columns">
                <div class="socialLinks">
                    <a href="#">
                        <img src="{{ m(asset('img/facebook.png')) }}">
                    </a>
                    <a href="#">
                        <img src="{{ m(asset('img/twitter.png')) }}">
                    </a>
                    <a href="#">
                        <img src="{{ m(asset('img/instagram.png')) }}">
                    </a>
                    <a href="#">
                        <img src="{{ m(asset('img/telegram.png')) }}">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="navBar">
        <nav class="sticky-container" data-sticky-container>
            <div class="sticky topnav" data-sticky data-top-anchor="navBar" data-btm-anchor="footer-bottom:bottom"
                 data-margin-top="0" data-margin-bottom="0" style="width: 100%; background: #fff;"
                 data-sticky-on="large">
                <div class="row">
                    <div class="large-12 columns">
                        <div class="title-bar" data-responsive-toggle="beNav" data-hide-for="large">
                            <button class="menu-icon" type="button" data-toggle="offCanvas-responsive"></button>
                            <div class="title-bar-title"><img class="header-logo" src="{{ m(asset('img/logo.png')) }}" alt="titar"></div>
                        </div>

                        <div class="top-bar show-for-large" id="beNav">
                            <div class="top-bar-right">
                                <ul class="menu">
                                    <li class="menu-text">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ m(asset('img/logo.png')) }}" class="header-logo" alt="titar">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="top-bar-left search-btn">
                                <ul class="menu">
                                    <li class="search">
                                        <i class="fa fa-search"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="top-bar-right">
                                <ul class="menu vertical medium-horizontal"
                                    data-responsive-menu="drilldown medium-dropdown">
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
                            </div>
                        </div>
                    </div>
                </div>
                @include('pages.front.__search')
            </div>
        </nav>
    </section>
</header>

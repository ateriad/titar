<!-- footer -->
<footer>
    <div class="row">
        <div class="large-4 medium-6 columns">
            <div class="widgetBox">
                <div class="widgetTitle">
                    <h5>پلتفرم واقعیت مجازی تیتار</h5>
                </div>
                <div class="textwidget">
                    <p class="col">
                        <i class="fas fa-map-marker-alt"></i>
                        <a href="https://www.google.com/maps?q=35.759489,51.406710">میدان ونک، خیابان ونک، پلاک 24</a>
                    </p>
                    <p class="col">
                        <i class="fa fa-phone"></i>
                        <a href="tel:+982188653250">02188653250</a>
                    </p>
                    <p class="col">
                        <i class="fa fa-envelope-open"></i>
                        <a href="mailto:info@titar.ir">info@titar.ir</a>
                    </p>
                    <div class="social-links">
                        <a class="secondary-button" href="#"><img src="{{ m(asset('img/facebook.png')) }}"></a>
                        <a class="secondary-button" href="#"><img src="{{ m(asset('img/twitter.png')) }}"></a>
                        <a class="secondary-button" href="#"><img src="{{ m(asset('img/instagram.png')) }}"></a>
                        <a class="secondary-button" href="#"><img src="{{ m(asset('img/telegram.png')) }}"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="large-4 medium-6 columns">
            <div class="widgetBox">
                <div class="widgetTitle">
                    <h5></h5>
                </div>
                <div class="widgetContent">
                    <ul>
                        <li><a href="{{ route('home') }}">خانه</a></li>
                        <li><a href="{{ route('auth.otp.show') }}">ورود کاربران</a></li>
                        <li><a href="{{ route('terms.show') }}">شرایط و قوانین</a></li>
                        <li><a href="{{ route('about.show') }}">درباره ما</a></li>
                        <li><a href="{{ route('contact.show') }}">تماس با ما</a></li>
                        <li><a href="{{ route('application.show') }}">اپلیکیشن ها</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="large-4 medium-6 columns">
            <div class="widgetBox">
                <div class="widgetTitle">
                    <h5></h5>
                </div>
                <div class="widgetContent">
                    <form data-abide novalidate method="post" action="{{ route('newsletter.store') }}">
                        @csrf
                        <div class="input">
                            <input type="email" id="email" required
                                   placeholder="ثبت ایمیل در خبرنامه"
                                   value="{{auth()->check() ? auth()->user()->email : ''}}">
                        </div>
                        <button class="button" type="submit" value="Submit">عضویت در خبرنامه</button>
                    </form>
                    <div class="logos">
                        <h5>گواهی‌ نامه‌ها</h5>
                        <a target="popup"
                           href="https://trustseal.enamad.ir/?id=148619&code=odHh7d1JYUO5M5UcEYwT"
                           onclick="window.open('https://trustseal.enamad.ir/?id=148619&code=odHh7d1JYUO5M5UcEYwT','popup','width=600,height=600'); return false;">
                            <img src="{{asset('img/enamad.png')}}" alt="Enamad">
                        </a>
                        <a target="popup"
                           href="https://pub.daneshbonyan.ir/"
                           onclick="window.open('https://pub.daneshbonyan.ir/','popup','width=600,height=600'); return false;">
                            <img src="{{asset('img/daneshbonyan.png')}}" alt="دانش بنیان">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" id="back-to-top" title="Back to top"><i class="fa fa-angle-double-up"></i></a>
</footer><!-- footer -->
<div id="footer-bottom">
    <div class="logo text-center">
        <img src="{{ asset('img/logo.png?md5=logo-big.png') }}" alt="titar">
    </div>
    <div class="btm-footer-text text-center">
        <p>کلیه حقوق برای تیتار محفوظ می‌باشد.</p>
    </div>
</div>

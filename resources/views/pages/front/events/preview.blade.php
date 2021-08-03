@extends('pages.front._layout')

@section('title', $event->title)

@section('head-links')
    @parent
@endsection

@section('content')
    <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
            @include('pages.front.__top_bar')
            <div class="off-canvas-content" data-off-canvas-content>
                @include('pages.front.__header')
                <div class="row margin-top-20">
                    <div class="large-12 columns">
                        <section class="inner-video">
                            <div class="row secBg">
                                <div class="large-12 columns inner-flex-video padding-0">
                                    <div class="video-single-img">
                                        <a href="{{ route('events.show', $event) }}">
                                            <img class="w-100 h-100" src="{{ $event->attribute('banner') }}"
                                                 alt="{{ $event->title }}"/>
                                            <div>
                                                <button class="button">
                                                    <span><i class="fa fa-play-circle"></i>مشاهده رویداد</span>
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="SinglePostStats">
                            <div class="row secBg">
                                <div class="large-12 columns">
                                    <div class="media-object stack-for-small">
                                        <div class="media-object-section">
                                        </div>
                                        <div class="media-object-section object-second">
                                            <div class="author-des clearfix">
                                                <div class="post-title">
                                                    <h4>{{ $event->title }}</h4>
                                                    <p>
                                                        <span>
                                                            {{ jDate($event->created_at) }}
                                                            <i class="fa fa-clock"></i>
                                                        </span>
                                                        <span>
                                                            {{ count($event->product->visits) }}
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                        <span>
                                                            {{ $event->product->likes() }}
                                                            <i class="fa fa-thumbs-up"></i>
                                                        </span>
                                                        <span>
                                                            {{ $event->product->dislikes() }}
                                                            <i class="fa fa-thumbs-down"></i>
                                                        </span>
                                                        <span>
                                                            {{ count($event->product->comment) }}
                                                            <i class="fa fa-comment"></i>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="pull-left">
                                                    <div class="post-like-btn clearfix">
                                                        <a id="dislike" class="secondary-button"><i
                                                                class="fa fa-thumbs-down"></i></a>
                                                        <a id="like" class="secondary-button"><i
                                                                class="fa fa-thumbs-up"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="singlePostDescription">
                            <div class="row secBg">
                                <div class="large-12 columns">
                                    <div class="heading">
                                        <h5>توضیحات رویداد</h5>
                                    </div>
                                    <div class="description showmore_one">
                                        <p>{{ $event->content }}</p>
                                        <div class="categories">
                                            <button>دسته بندی</button>
                                            @foreach($event->categories as $c)
                                                <a href="{{ route('events.categories.show', $c->id) }}"
                                                   class="inner-btn">{{ $c->title }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="content comments">
                            <div class="row secBg">
                                <div class="large-12 columns">
                                    <div class="main-heading borderBottom">
                                        <div class="row padding-14">
                                            <div class="medium-12 small-12 columns">
                                                <div class="head-title">
                                                    <h4>دیدگاه‌ها</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="comment-box">
                                        <div class="media-object stack-for-small">
                                            @if(auth()->id())
                                                <form method="post" action="{{ route('events.comments', $event->id) }}"
                                                      class="rtl text-right">
                                                    @csrf
                                                    @if($errors->any())
                                                        <div class="alert alert-danger rtl">
                                                            <ul class="mb-0">
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    @if(session('error'))
                                                        <div class="alert alert-danger rtl">{{ session('error') }}</div>
                                                    @endif

                                                    @if(session('success'))
                                                        <div
                                                            class="alert alert-success rtl">{{ session('success') }}</div>
                                                    @endif

                                                    <div class="form-group">
                            <textarea name="content" class="form-control" title="پیام"
                                      placeholder="پیام">{{ old('content') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        @csrf
                                                        <input type="submit" class="btn btn-purple" value="فرستادن">
                                                    </div>
                                                </form>
                                            @else
                                                <div class="alert alert-warning rtl">
                                                    <span>برای نوشتن دیدگاه لطفا</span>
                                                    <a href="{{ route('auth.otp.show') }}">وارد شوید</a><span>.</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="main-comment">
                                        @if(count($comments))
                                            @foreach($comments as $comment)
                                                <div class="media-object stack-for-small">
                                                    <div class="media-object-section comment-desc">
                                                        <div class="comment-title">
                                                            <span class="name"><a>{{ $comment->name }}</a></span>
                                                            <span class="time float-right">
                                                                @ {{ jDate($comment->created_at) }}
                                                            </span>
                                                        </div>
                                                        <div class="comment-text">
                                                            <p>{{ $comment->content }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row">
                                                <div class="large-12 columns">
                                                    <div class="alert alert-secondary rtl">
                                                        هیچ دیدگاهی برای این رویداد فرستاده نشده است.
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.front.__footer')
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('vendor/notify/notify.min.js') }}"></script>
    <script>
        $('#like, #dislike').click(function () {
            let type = $(this).attr('id') === 'like' ? 1 : 2;
            let likeBtn = $('#like');
            let dislikeBtn = $('#dislike');

            $.ajax({
                method: 'post',
                url: '{{ route('events.reactions', $event) }}',
                data: JSON.stringify({
                    type: type,
                }),
                contentType: 'application/json',
                dataType: 'json',
            }).done(function (response) {
                $('#likes').html(response['likes']);
                $('#dislikes').html(response['dislikes']);
                likeBtn.removeClass('green-btn');
                dislikeBtn.removeClass('red-btn');
                $('#like, #dislike').addClass('btn-secondary');
                response['reaction'] === 1 ? likeBtn.addClass('green-btn') : dislikeBtn.addClass('red-btn');
            }).fail(function (e) {
                if (e.status === 400) {
                    $.notify(e['responseJSON']['error'], 'error');
                } else if (e.status === 401) {
                    $.notify('لطفا ابتدا وارد شوید...', 'error');
                } else {
                    console.log(e);
                    $.notify('مشکلی پیش آمده لطفا دوباره تلاش کنید...', 'error');
                }
            });
        });
    </script>
@endsection

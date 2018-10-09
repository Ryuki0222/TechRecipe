<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- css -->
        <link rel="stylesheet" href="/css/item.css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Swiper -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js"></script>
        <title>TechRecipe</title>
    </head>
    <body>
    <div class="header">
        <div class="title"><a href="/"></a></div>
        <form action="/search" method="GET">
            <i class="fa fa-search"></i>
            <input class="search_form" type="text" name="q" placeholder="キーワードを入力" />
        </form>
        @if (Auth::check())
        <img class="user_icon" src="{{ Auth::user()->img_path }}" />
        @else
        <div class="btn_github">
            <i class="fa fa-github"></i>
            <a href="/auth/github">ログイン</a>
        </div>
        @endif
    </div>
    <div class="main">
        <div class="basic_info">
            <h1 class="product_title">{{ $work->work_name }}</h1>
            <img class="product_image" src="{{ asset('/img/'.$work->work_img_path) }}" />
        <h4 class="maker_name">by. <a href="/users/{{ $user->user_name }}">{{ $user->user_name }}</a>（{{$work->created_at}}）</h4>
            <ul>
                <li class="product_description">
                    <h2>作品概要</h2>
                    <p>{{ $work->work_description }}</p>
                </li>
                <li class="product_url">
                    <h2>作品URL</h2>
                    <a href="{{ $work->github_url }}">{{ $work->github_url }}</a>
                </li>
                <li class="product_tag">
                    <h2>タグ</h2>
                    <div class="tag">
                    @foreach ($tags as $tag)
                    <a href="/tags/{{ $tag->id }}">{{ $tag->tag_name }}</a>
                    @endforeach
                    </div>
                </li>
            </ul>
        </div>
        <div class="product_flow">
            <h1 class="flow_title">レシピ</h1>
            <div class="swiper-container">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($flows as $flow)
                    <div class="swiper-slide">
                        <img src="{{ asset('/img/'.$flow->flow_img_path) }}" />
                        <h3>{{ $flow->flow_no }}/{{ $numberofflow }}</h3>
                        <p>{{ $flow->flow_description }}</p>
                        <h3>参考リンク</h3>

                    </div>
                    @endforeach
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
    <!-- <div class="footer"><div> -->
    <a href="/new" class="new_btn"><i class="fa fa-plus"></i></a>
    <script src="{{ asset('/js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/swiper.js') }}" type="text/javascript"></script>
</body>
</html>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- css -->
        <link rel="stylesheet" href="/css/style.css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
        <a href="/new" class="new_btn"><i class="fa fa-plus"></i></a>
        @else
        <div class="btn_github">
            <i class="fa fa-github"></i>
            <a href="/auth/github">ログイン</a>
        </div>
        @endif
    </div>
    <div class="main">
        @if ($message !== '')
        <h1>{{ $message }}</h1>
        @endif
        <div class="works">
            @foreach ($works as $work)
            <div class="work">
                <img class="icon" src="{{ asset('/img/'.$work->work_img_path) }}" alt="" onError="this.onerror=null;this.src='{{ asset('/img/IMG_0303.JPG') }}';" />
            <a class="work_name" href="/items/{{ $work->hash }}">{{ $work->work_name }}</a>
            <div class="tag">
                @foreach ($work->skill as $skill)
                    <a href="/tags/{{ $skill->tag_id }}">{{$skill->tag->tag_name}}</a>
                @endforeach
            </div>
                <div class="detail"><span>by. <a href="/users/{{ $work->user->user_name }}">{{ $work->user->user_name }}</a><br />{{ $work->created_at }}</span></div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- <div class="footer"><div> -->
    <script src="{{ asset('/js/main.js') }}" type="text/javascript"></script>
</body>
</html>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- css -->
        <link rel="stylesheet" href="/css/new.css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>レシピ投稿 - TechRecipe</title>
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
        {!! Form::open(['url' => '/new/add', 'method' => 'post', 'files' => true]) !!}
            <input type="hidden" name="github_id" value="{{ Auth::user()->github_id }}" />
            {{ csrf_field() }}
            <div class="work_img"><span>作品を表す画像をアップロード</span></div>
            {{Form::file('work_img', ['class' => 'work_img_uploder'])}}
            <ul>
                <li class="work_name"><input type="text" name="work_name" placeholder="作品名" /></li>
                <li class="skills"><input type="text" name="skills" placeholder="使用したプログラミング技術を半角スペース区切りで入力（例: Unity C#）" /></li>
                <li class="github_url"><input type="text" name="github_url" placeholder="作品GitHubURL" /></li>
                <li class="work_description"><textarea name="work_description" placeholder="概要"></textarea></li>
            </ul>
            <h3>制作手順</h3>
            <div class="flows">
                <div class="flow" data-no="1">
                    <h4>制作フロー 1</h4>
                    <div class="flow_img"><span>作品を表す画像をアップロード</span></div>
                    {{Form::file('flow_img[]', ['class' => 'flow_img_uploder'])}}
                    <textarea class="flow_description" name="flow_description[]" placeholder="作り方の説明"></textarea>
                    <textarea class="flow_reference" name="flow_reference[]" placeholder="参考にしたURLリスト"></textarea>
                </div>
                <div class="plus"><i class="fa fa-plus"></i></div>
                <div class="buttons">
                    <!-- <button class="save">下書き保存</button> -->
                    <button class="submit">TechRecipeに投稿</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <script src="{{ asset('/js/main.js') }}" type="text/javascript"></script>
</body>
</html>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- css -->
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

        <title>TechRecipe</title>
    </head>
    <body>
    <div class="header">
        <div class="title"><a href="./"></a></div>
        <form action="/search" method="GET">
            <i class="fa fa-search"></i>
            <input class="search_form" type="text" name="q" placeholder="キーワードを入力" />
        </form>
        <div class="btn_github">
            <i class="fa fa-github"></i>
            <a href="/auth/github">ログイン</a>
        </div>
    </div>
    <div class="main">
        <div class="message_area">
            <div class="catch_copy">なんかかっこいいキャッチコピーを<br />いれてみたいね</div>
            <div class="detail">TechRecipeはプログラミング作品の開発手順・ソースコードを共有するサービスです！<br />本当に自分がつくりたいプログラミング作品を探してモチベーション高く技術力を向上させよう！</div>
        </div>
        @if (isset( $data ))
        <ul>
            @foreach($data as $d)
            <li>{{$d->user_name}}</li>
            @endforeach
        </ul>
        @endif
        <div class="works">
            <div class="work">
                <div class="icon"></div>
                <div class="work_name">Unityで対人型オセロをつくってみた</div>
                <div class="tag"><span>Unity</span><span>C#</span></div>
                <div class="detail"><span>by. Sho Kubota（2018.08.26）</span></div>
            </div>
            <div class="work">
                <div class="icon"></div>
                <div class="work_name">Unityで対人型オセロをつくってみた</div>
                <div class="tag"><span>Unity</span><span>C#</span></div>
                <div class="detail"><span>by. Sho Kubota（2018.08.26）</span></div>
            </div>
            <div class="work">
                <div class="icon"></div>
                <div class="work_name">Unityで対人型オセロをつくってみた</div>
                <div class="tag"><span>Unity</span><span>C#</span></div>
                <div class="detail"><span>by. Sho Kubota（2018.08.26）</span></div>
            </div>
            <div class="work">
                <div class="icon"></div>
                <div class="work_name">Unityで対人型オセロをつくってみた</div>
                <div class="tag"><span>Unity</span><span>C#</span></div>
                <div class="detail"><span>by. Sho Kubota（2018.08.26）</span></div>
            </div>
            <div class="work">
                <div class="icon"></div>
                <div class="work_name">Unityで対人型オセロをつくってみた</div>
                <div class="tag"><span>Unity</span><span>C#</span></div>
                <div class="detail"><span>by. Sho Kubota（2018.08.26）</span></div>
            </div>
            <div class="work">
                <div class="icon"></div>
                <div class="work_name">Unityで対人型オセロをつくってみた</div>
                <div class="tag"><span>Unity</span><span>C#</span></div>
                <div class="detail"><span>by. Sho Kubota（2018.08.26）</span></div>
            </div>
            <div class="work">
                <div class="icon"></div>
                <div class="work_name">Unityで対人型オセロをつくってみた</div>
                <div class="tag"><span>Unity</span><span>C#</span></div>
                <div class="detail"><span>by. Sho Kubota（2018.08.26）</span></div>
            </div>
            <div class="work">
                <div class="icon"></div>
                <div class="work_name">Unityで対人型オセロをつくってみた</div>
                <div class="tag"><span>Unity</span><span>C#</span></div>
                <div class="detail"><span>by. Sho Kubota（2018.08.26）</span></div>
            </div>
        </div>
    </div>
</body>
</html>

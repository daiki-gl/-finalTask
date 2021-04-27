<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id="head" class="header header-container">
        <h1><a href="/top"><img src="images/main_logo.png"></a></h1>

            <div id="" class="pulldown-container">

                <div class="name-box">
                    <div id="js-pulldown" class="pull-btn">
                        <p>{{Auth::user()['username']}} さん</p>
                        <a class="arrow" href="">
                            <span class="arrow-left"></span>
                            <span class="arrow-right"></span>
                        </a>
                    </div>
                    @foreach($userImage as $userImage)
                    <img class="prof-img" src="images/icons/{{ $userImage->images }}" alt="">
                    @endforeach
                    </div>
                <div class="menu-box">
                    <ul class="menu-list">
                        <li class="menu-item"><a href="/top">ホーム</a></li>
                        <li class="menu-item"><a href="/profile">プロフィール</a></li>
                        <li class="menu-item"><a href="/logout" onclick="return confirm('ログアウトしてもよろしいですか？')">ログアウト</a></li>
                    </ul>
                </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm" class="confirm">
                <p>{{Auth::user()['username']}}さんの</p>
                    <div class="follow-num-box">
                    <p>フォロー数</p>
                    <p>{{ $followCount }} 名</p>
                    </div>
                <a class="btn" href="/follow-list">フォローリスト</a>
                    <div class="follow-num-box">
                    <p>フォロワー数</p>
                    <p>{{$followerCount}} 名</p>
                    </div>
                <a class="btn" href="/follower-list">フォロワーリスト</a>
            </div>
            <a class="btn search-btn" href="/search">ユーザー検索</a>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/index.js"></script>
    <script>
    function myFunction() {
        $('#js-label').addClass('changed');
    }
    </script>
</body>
</html>
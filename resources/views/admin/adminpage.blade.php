<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('css/nagoyameshi.css') }}" rel="stylesheet">
</head>

<body style="height: 100vh">
    <div class="container mt-3">
        <div clasa="row h-100">
            <div class="col-12 text-center">
                <h2>管理者ページ</h2>
            </div>
            <hr>
            <div class="col-10 offset-1 py-5">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="card-title">店舗一覧</h3>
                                <p class="card-text my-1">店舗情報の編集・登録</p>
                            </div>
                            <div class="card-footer text-center py-0">
                                <a href="{{route('admin.restaurants')}}" class="btn">一覧</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="card-title">会員一覧</h3>
                                <p class="card-text my-1">会員情報の編集</p>
                            </div>
                            <div class="card-footer text-center py-0">
                                <a href="{{route('admin.users')}}" class="btn">一覧</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="card-title">カテゴリ一覧</h3>
                                <p class="card-text my-1">カテゴリ編集・登録</p>
                            </div>
                            <div class="card-footer text-center py-0">
                                <a href="{{route('admin.categories')}}" class="btn">一覧</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
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

<body>
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="row">
                    <div class="col-4">
                        <span>
                            <a href="{{ route('admin') }}">アドミンページ</a> > 会員一覧
                        </span>
                        <h2 class="mt-3 mb-3">会員一覧</h2>
                    </div>
                    <div class="col-2 offset-6 position-relative">
                        <button class="btn btn-success btn-lg position-absolute bottom-0 end-0">登録</button>
                    </div>
                </div>
                <hr>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">名前</th>
                            <th scope="col">メールアドレス</th>
                            <th scope="col">有料会員</th>
                        </tr>
                    </thead>
                    @foreach($users as $user)
                    <tbody>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @if($user->stripe_id !==NULL)
                        <td>&#9675;</td>
                        @else
                        <td>&#10005;</td>
                        @endif
                        <td>編集</td>
                        <td>削除</td>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>

</html>
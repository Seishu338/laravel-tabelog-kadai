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
                            <a href="{{ route('admin') }}">アドミンページ</a> > カテゴリ一覧
                        </span>
                        <h2 class="mt-3 mb-3">カテゴリ一覧</h2>
                    </div>
                    <div class="col-2 offset-6 position-relative">
                        <form action="{{route('categories.create')}}">
                            <button type="submit" class="btn btn-success btn-lg position-absolute bottom-0 end-0">登録</button>
                        </form>
                    </div>
                </div>
                <hr>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">カテゴリ</th>
                        </tr>
                    </thead>
                    @foreach($categories as $category)
                    <tbody>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td><a href="{{route('categories.edit', $category)}}">編集</a></td>
                        <form action="{{route('categories.destroy', $category)}}" method="POST">
                            @csrf
                            @method('delete')
                            <td><button type="submit" class="btn btn-danger">削除</button></td>
                        </form>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>

</html>
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-2">
                <a href="{{route('admin.categories')}}" class="text-decoration-none">&lt; 戻る</a>
            </div>
            <div class="card">
                <div class="card-header">
                    カテゴリ登録
                </div>
                <div class="card-body">
                    <form action="{{route('categories.store')}}" method="POST">
                        @csrf
                        <div class="form-group row my-2">
                            <label for="name" class="col-md-4 col-form-label text-md-end">カテゴリ名</label>
                            <div class="col-md-6">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>カテゴリ名を入力してください</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">送信</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</html>
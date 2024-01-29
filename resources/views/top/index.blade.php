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
    <div id="app">
        @component('components.header')
        @endcomponent
        <main>
            <div class="top">
                <div class="position-absolute top-50 start-50 translate-middle main-title">
                    <h1><a href="{{route('restaurants.index')}}" class="link-white">NAGOYAMESHI</a></h1>
                </div>
                <div class="position-absolute end-0">
                    <a style="color:blue;" href="https://jp.freepik.com/free-photo/pen-on-blank-spiral-notepad-surrounded-with-thai-traditional-food-on-wooden-table_4273375.htm?query=%E6%96%99%E7%90%86%20%E4%BF%AF%E7%9E%B0#from_view=detail_alsolike">img byFreepik</a>
                </div>
            </div>
        </main>
        @component('components.footer')
        @endcomponent
    </div>
    @stack('scripts')
</body>

</html>
@extends('layouts.app')

@section('content')
<div class="container  d-flex justify-content-center mt-3">
    <div class="w-75">
        <span>
            <a href="{{ route('mypage') }}">マイページ</a> > お気に入り
        </span>
        <h2 class="mt-3 mb-3">お気に入り</h2>

        <hr>
        @if($favorites->isEmpty())
        <h3>現在、お気に入りはありません。
        </h3>
        @endif
        <div class="row">
            @foreach ($favorites as $fav)
            <div class="col-md-7 mt-2">
                <div class="d-inline-flex">
                    <img src="{{ asset('img/dummy.jpg')}}" class="img-fluid w-100">
                    <div class="container mt-3">
                        <h5 class="w-100">{{App\Models\Restaurant::find($fav->favoriteable_id)->name}}</h5>
                        <h6 class="w-100">{{App\Models\Restaurant::find($fav->favoriteable_id)->strating_time}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <a href="{{ route('restaurants.favorite', $fav->favoriteable_id) }}">
                    削除
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
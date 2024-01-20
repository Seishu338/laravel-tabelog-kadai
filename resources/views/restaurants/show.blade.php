@extends('layouts.app')
@section('content')

<div class="container">
    <div class="mb-3">
        <h2>{{$restaurant->name}}</h2>
    </div>
    <div class="mb-2">
        <a href="{{ route('restaurants.index') }}" class="text-decoration-none">&lt; 戻る</a>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <a href="{{route('restaurants.show', $restaurant)}}">
                <img src="{{ asset('img/dummy.jpg')}}" class="w-100">
            </a>
        </div>
        <div class="col-lg-8">
            <div>
                <p>
                    <sapn>カテゴリ：</sapn>{{$restaurant->category->name}}
                </p>
            </div>
            <div>
                <p>
                    <sapn>予算：</sapn>{{$restaurant->price}}
                </p>
            </div>
            <div>
                <p><span>営業時間：</span> {{$restaurant->starting_time}}～{{$restaurant->ending_time}}</p>
            </div>
            <div>
                <p><span>定休日：</span> @foreach($restaurant->closing_days as $closing_day)　{{$closing_day->name}}@endforeach</p>
            </div>
            <div>
                <p>{{$restaurant->description}}></p>
            </div>
            <div>
                <p><span>住所：</span>{{$restaurant->postal_code}}　{{$restaurant->address}}</p>
            </div>
            <div>
                <p>
                    <sapn>電話番号：</sapn>{{$restaurant->phone}}
                </p>
            </div>
        </div>
    </div>
    <div class="text-end">
        @if($restaurant->isFavoritedBy(Auth::user()))
        <a href="{{route('restaurants.favorite',$restaurant)}}" class="btn btn-success btn-lg">お気に入り解除</a>
        @else
        <a href="{{route('restaurants.favorite', $restaurant)}}" class="btn btn-outline-success btn-lg">お気に入り</a>
        @endif
    </div>
    <hr>
    <div>
        <h3>予約</h3>
    </div>
    <div class="d-flex justify-content-start mb-5">
        <div class="mx-1">
            <label>予約日</label>
            <select class="form-control" name="">
                <option value="">選択してください</option>
                @foreach($selects as $value)
                @foreach($day_ids as $day_id)
                @if($value->dayOfWeekIso == $day_id)
                <option value="" disabled>{{$value->format('Y-m-d')}}</option>
                @else
                <option value="">{{$value->format('Y-m-d')}}</option>
                @endif
                @endforeach
                @endforeach
            </select>
        </div>
        <div class="mx-1">
            <label>予約時間</label>
            <select class="form-control" name="">
                <option value="">選択してください</option>
                @foreach($selects2 as $value)
                <option value="">{{$value->format('H:i')}}</option>
                @endforeach
            </select>
        </div>
        <div class="mx-1">
            <label>人数</label>
            <select class="form-control" name="">
                <option value="">選択してください</option>
                @foreach(range(1,30) as $i)
                <option value="">{{$i}}人</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <h3>レビュー</h3>
    </div>
    <div>
        <a class="btn btn-primary" href="{{route('reviews.create', ['restaurant'=>$restaurant->id])}}" role="button">投稿</a>
    </div>
    <div>
        @foreach($reviews as $review)
        <div>
            <p>{{$review->user->name}}</p>
        </div>
        <div>
            <p>{{$review->content}}</p>
        </div>
        <hr>
        @endforeach
    </div>

</div>
@endsection
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="mb-3">
        <a href="{{ route('restaurants.index') }}" class="text-decoration-none">&lt; 戻る</a>
    </div>
    <div class="mb-3">
        <h2>{{$restaurant->name}}</h2>
        <h3><span class="avg-score" data-id="{{$staravg}}"></span>{{$restaurant->average_score}}</h3>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <a href="{{route('restaurants.show', $restaurant)}}">
                @if ($restaurant->image !== "")
                <img src="{{ asset($restaurant->image)}}" class="img-thumbnail">
                @else
                <img src="{{ asset('img/dummy.jpg')}}" class="img-thumbnail">
                @endif
            </a>
            </a>
        </div>
        <div class="col-lg-8 show-items">
            <div>
                <p>
                    <sapn class="show-item">カテゴリ</sapn>：{{$restaurant->category->name}}
                </p>
            </div>
            <div>
                <p>
                    <sapn class="show-item">予算</sapn>：{{$restaurant->price}}円～
                </p>
            </div>
            <div>
                <p><span class="show-item">営業時間</span>：{{date('H:i', strtotime($restaurant->starting_time))}}～{{date('H:i', strtotime($restaurant->ending_time))}}</p>
            </div>
            <div>
                <p><span class="show-item">定休日</span>： @foreach($restaurant->closing_days as $closing_day)&nbsp;{{$closing_day->name}}@endforeach</p>
            </div>
            <div>
                <p><span class="show-item">住所</span>：〒{{$restaurant->postal_code}}&nbsp;{{$restaurant->address}}</p>
            </div>
            <div>
                <p>
                    <sapn class="show-item">電話番号</sapn>：{{$restaurant->phone}}
                </p>
            </div>
            <div>
                <p>{{$restaurant->description}}></p>
            </div>
        </div>
    </div>
    @if(Auth::user()->stripe_id!==NULL)
    <div class="text-end">
        @if($restaurant->isFavoritedBy(Auth::user()))
        <a href="{{route('restaurants.favorite',$restaurant)}}" class="btn btn-success btn-lg">お気に入り解除</a>
        @else
        <a href="{{route('restaurants.favorite', $restaurant)}}" class="btn btn-outline-success btn-lg">お気に入り</a>
        @endif
    </div>
    @endif
    <hr>
    <div class="row my-3">
        @if(Auth::user()->stripe_id!==NULL)
        <div>
            <h3>予約</h3>
        </div>
        <form action="{{route('restaurants.reservation')}}" method="post" class="my-2">
            <div class="row row-cols-auto">
                @csrf
                <div class="col mx-1">
                    <label>予約日</label>
                    <select class="form-control @error('reservations_date') is-invalid @enderror" required name="reservations_date">
                        <option value="">選択してください</option>
                        @foreach($selects as $value)
                        @if(in_array($value->dayOfWeekIso, $day_ids))
                        <option value="" disabled>{{$value->format('Y-m-d')}}</option>
                        @else
                        <option value="{{$value}}">{{$value->format('Y-m-d')}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('reservations_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col mx-1">
                    <label>予約時間</label>
                    <select class="form-control  @error('reservations_time') is-invalid @enderror" required name="reservations_time">
                        <option value="">選択してください</option>
                        @foreach($selects2 as $value)
                        <option value="{{$value}}">{{$value->format('H:i')}}</option>
                        @endforeach
                    </select>
                    </select>
                    @error('reservations_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col mx-1">
                    <label>人数</label>
                    <select class="form-control @error('number') is-invalid @enderror" required name="number">
                        <option value="">選択してください</option>
                        @foreach(range(1,30) as $i)
                        <option value="{{$i}}">{{$i}}人</option>
                        @endforeach
                    </select>
                    @error('number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                <div class="col mx-2 my-1">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-primary btn-lg">予約</button>
                </div>
                <div class="modal fade" id="confirmModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="confirmModalToggleLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalToggleLabel">予約を確定しますか？</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                <button type="submit" class="btn btn-primary">予約</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @else
        <p class="text-center" style="font-size:16px;">有料会員になることで、予約機能、レビュー投稿機能、お気に入り機能を利用することができます。</p>
        @endif
    </div>
    <hr>
    <div class="row">
        <h3>レビュー</h3>
        @if(Auth::user()->stripe_id!==NULL)
        <div class="my-3">
            <a class="btn btn-primary btn-lg" href="{{route('reviews.create', ['restaurant'=>$restaurant->id])}}" role="button">新規投稿</a>
        </div>
        @endif
        <div class="my-3">
            @foreach($reviews as $review)
            <div>
                <p class="review-name">{{$review->user->name}}</p>
                <h3 class="star">{{str_repeat('★',$review->score)}}</h3>
                <p>{{$review->content}}</p>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $reviews->links() }}
    </div>
</div>
@endsection
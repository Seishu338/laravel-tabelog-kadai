@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="my-3">レビュー投稿</h1>
    <div class="mb-2">
        <a href="{{route('restaurants.show',$restaurant)}}" class="text-decoration-none">&lt; 戻る</a>
    </div>

    <form action="{{ route('reviews.store') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="score">評価</label>
            <select name="score" class="form-control m-2 review-score-color star">
                <option value="5" class="review-score-color">★★★★★</option>
                <option value="4" class="review-score-color">★★★★</option>
                <option value="3" class="review-score-color">★★★</option>
                <option value="2" class="review-score-color">★★</option>
                <option value="1" class="review-score-color">★</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="content">本文</label>
            <textarea class="form-control" name="content"></textarea>
            @error('content')
            <strong>レビューを入力してください</strong>
            @enderror
        </div>
        <input type="hidden" name="restaurant_id" value="{{$restaurant}}">
        <button type="submit" class="btn btn-outline-primary">投稿</button>
    </form>
</div>

@endsection
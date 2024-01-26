@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          店舗登録
        </div>
        <div class="card-body">
          <form action="{{route('restaurants.store')}}" method="POST">
            @csrf
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-end">店舗名</label>
              <div class="col-md-6">
                <input type="text" name="name" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-end">説明</label>
              <div class="col-md-6">
                <textarea name="description" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="starting_time" class="col-md-4 col-form-label text-md-end">営業開始時間</label>
              <div class="col-md-6">
                <input type="time" name="starting_time" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label for="ending_time" class="col-md-4 col-form-label text-md-end">営業終了時間</label>
              <div class="col-md-6">
                <input type="time" name="ending_time" class="form-control">
              </div>
            </div>
        </div>
        <div class="form-group row">
          <label for="price" class="col-md-4 col-form-label text-md-end">予算</label>
          <div class="col-md-6">
            <input type="number" name="price" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="postal_code" class="col-md-4 col-form-label text-md-end">郵便番号</label>
          <div class="col-md-6">
            <input type="text" name="postal_code" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="address" class="col-md-4 col-form-label text-md-end">住所</label>
          <div class="col-md-6">
            <input type="text" name="address" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="phone" class="col-md-4 col-form-label text-md-end">電話番号</label>
          <div class="col-md-6">
            <input type="text" name="phone" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="closing_day" class="col-md-4 col-form-label text-md-end">定休日</label>
          <div class="col-md-6">
            @foreach($days as $day )
            <div class="form-check  form-check-inline">
              <input class="form-check-input" type="checkbox" name="day_ids[]" value="{{$day->id}}" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">{{$day->name}}</label>
            </div>
            @endforeach
          </div>
          <div class="form-group row">
            <label for="category_id" class="col-md-4 col-form-label text-md-end">カテゴリ</label>
            <div class="col-md-6">
              <select name="category_id">
                <option value="">選択</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
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
@endsection
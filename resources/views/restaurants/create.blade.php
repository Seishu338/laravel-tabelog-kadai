@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="mb-2">
        <a href="{{route('admin.restaurants')}}" class="text-decoration-none">&lt; 戻る</a>
      </div>
      <div class="card">
        <div class="card-header">
          店舗登録
        </div>
        <div class="card-body">
          <form action="{{route('restaurants.store')}}" method="POST">
            @csrf
            <div class="form-group row my-2">
              <label for="name" class="col-md-4 col-form-label text-md-end">店舗名</label>
              <div class="col-md-6">
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>店舗名を入力してください</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="description" class="col-md-4 col-form-label text-md-end">説明</label>
              <div class="col-md-6">
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>説明欄を入力してください</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="category_id" class="col-md-4 col-form-label text-md-end">カテゴリ</label>
              <div class="col-md-6">
                <div class="@error('category_id') is-invalid @enderror">
                  <select name="category_id">
                    <option value="">選択</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                @error('category_id')
                <span class="invalid-feedback" role="alert">
                  <strong>カテゴリを入力してください</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="starting_time" class="col-md-4 col-form-label text-md-end">営業開始時間</label>
              <div class="col-md-6">
                <div class="@error('starting_time') is-invalid @enderror">
                  <select class="form-control" name="starting_time">
                    <option value="">選択してください</option>
                    @foreach(range(1,24) as $i)
                    <option value="{{$i*10000}}">{{$i}}時</option>
                    @endforeach
                  </select>
                </div>
                @error('starting_time')
                <span class="invalid-feedback" role="alert">
                  <strong>営業開始時間を入力してください</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="ending_time" class="col-md-4 col-form-label text-md-end">営業終了時間</label>
              <div class="col-md-6">
                <div class="@error('ending_time') is-invalid @enderror">
                  <select class="form-control" name="ending_time">
                    <option value="">選択してください</option>
                    @foreach(range(1,24) as $i)
                    <option value="{{$i*10000}}">{{$i}}時</option>
                    @endforeach
                  </select>
                </div>
                @error('ending_time')
                <span class="invalid-feedback" role="alert">
                  <strong>営業終了時間を入力してください</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="phone" class="col-md-4 col-form-label text-md-end">電話番号</label>
              <div class="col-md-6">
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>電話番号を入力してください</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="price" class="col-md-4 col-form-label text-md-end">予算</label>
              <div class="col-md-6">
                <input type="number" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror">
                @error('price')
                <span class="invalid-feedback" role="alert">
                  <strong>予算を入力してください</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="postal_code" class="col-md-4 col-form-label text-md-end">郵便番号</label>
              <div class="col-md-6">
                <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control @error('postal_code') is-invalid @enderror">
                @error('postal_code')
                <span class="invalid-feedback" role="alert">
                  <strong>郵便番号を入力してください</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="address" class="col-md-4 col-form-label text-md-end">住所</label>
              <div class="col-md-6">
                <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror">
                @error('address')
                <span class="invalid-feedback" role="alert">
                  <strong>住所を入力してください</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="closing_day" class="col-md-4 col-form-label text-md-end">定休日</label>
              <div class="col-md-6">
                @foreach($days as $day )
                <div class="form-check  form-check-inline @error('day_ids') is-invalid @enderror">
                  <input class="form-check-input" type="checkbox" name="day_ids[]" value="{{$day->id}}" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">{{$day->name}}</label>
                </div>
                @endforeach
                @error('day_ids')
                <span class="invalid-feedback" role="alert">
                  <strong>定休日を入力してください</strong>
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
@endsection
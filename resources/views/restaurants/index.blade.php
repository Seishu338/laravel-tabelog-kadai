@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{route('restaurants.index')}}">
                <div class="form-group row my-2">
                    <div class="col-5">
                        <input type="text" class="form-control" name="search" value="{{$search}}" class="form-control" placeholder="店名">
                    </div>
                    <div class="col-5">
                        <select class="form-control" name="category_id">
                            <option value="">カテゴリ</option>
                            @foreach ($categories as $category)
                            @if($category_id == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 px-0 text-center">
                        <button type="submit" class="btn btn-primary">検索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="">
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                並び替え
            </button>
            <ul class="dropdown-menu">
                @if($category_id !==NULL && $search !==NULL)
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'high','category_id'=>$category_id, 'search'=>$search])}}">価格が高い順</a></li>
                @elseif($search !==NULL)
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'high','search'=>$search])}}">価格が高い順</a></li>
                @elseif($category_id !==NULL)
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'high', 'category_id'=>$category_id])}}">価格が高い順</a></li>
                @else
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'high'])}}">価格が高い順</a></li>
                @endif
                <li>
                    <hr class="dropdown-divider">
                </li>
                @if($category_id !==NULL && $search !==NULL)
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'row','category_id'=>$category_id, 'search'=>$search])}}">価格が低い順</a></li>
                @elseif($search !==NULL)
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'row','search'=>$search])}}">価格が低い順</a></li>
                @elseif($category_id !==NULL)
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'row', 'category_id'=>$category_id])}}">価格が低い順</a></li>
                @else
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'row'])}}">価格が低い順</a></li>
                @endif
                <li>
                    <hr class="dropdown-divider">
                </li>
                @if($category_id !==NULL && $search !==NULL)
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'score','category_id'=>$category_id, 'search'=>$search])}}">評価</a></li>
                @elseif($search !==NULL)
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'score','search'=>$search])}}">評価順</a></li>
                @elseif($category_id !==NULL)
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'score', 'category_id'=>$category_id])}}">評価順</a></li>
                @else
                <li><a class="dropdown-item" href="{{route('restaurants.index',['sort'=>'score'])}}">評価順</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="row">
        @foreach($restaurants as $restaurant)
        <div class="col-12 col-md-6 my-2 p-2">
            <div class="row restaurant-s">
                <div class="col-12 col-md-6 restaurant-img">
                    <a href="{{route('restaurants.show', $restaurant)}}">
                        @if ($restaurant->image !== "")
                        <img src="{{ asset($restaurant->image)}}">
                        @else
                        <img src="{{ asset('img/dummy.jpg')}}">
                        @endif
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <p class="mt-2 restaurant-name">{{$restaurant->name}} </p>
                            <p style="font-size:16px;">{{$restaurant->address}}&nbsp;/&nbsp;{{$restaurant->category->name}}</p>
                            <p style="font-size:16px;">￥{{$restaurant->price}}~</p>
                            <p class="mt-2 restaurant-score"><span class="avg-score" data-id="{{round($restaurant->average_score*2)/2}}"></span>{{$restaurant->average_score}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $restaurants->links() }}
    </div>
</div>

@endsection
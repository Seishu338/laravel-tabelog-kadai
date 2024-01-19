@extends('layouts.app')
@section('content')
<div class="container">  
    <h1 class="my-3">レビュー投稿</h1>
    <div class="mb-2">    
         <a href="#" class="text-decoration-none" onclick="history.back();">&lt; 戻る</a>                                
     </div>
     
     <form action="{{ route('reviews.store') }}" method="post">
         @csrf
         <div class="form-group mb-3">
             <label for="">評価</label>                        
             <input type="text" class="form-control" name="">
         </div>
         <div class="form-group mb-3">
             <label for="content">本文</label>                        
             <textarea class="form-control" name="content"></textarea>
         </div>
         <input type="hidden" name="restaurant_id" value="{{$restaurant}}">
         <button type="submit" class="btn btn-outline-primary">投稿</button>
     </form>
</div>

@endsection
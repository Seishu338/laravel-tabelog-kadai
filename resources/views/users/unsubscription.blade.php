@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <span>
                <a href="{{ route('mypage') }}">マイページ</a> > 有料会員解約
            </span>
            <h2 class="mt-3 mb-3">有料会員解約</h2>

            <hr>
        </div>
    </div>
    <div>
        @if($subscription->ends_at !==NULL)
        <h2>有料会員再開</h2>
        <form method="POST" action="{{route('stripe.resume') }}">
            @csrf
            <button class="btn btn-success mt-2">再開する</button>
        </form>
        @else
        <h2>有料会員退会</h2>
        <form method="POST" action="{{route('stripe.cancel') }}">
            @csrf
            <button class="btn btn-success mt-2">キャンセルする</button>
        </form>
        @endif
    </div>
    @endsection
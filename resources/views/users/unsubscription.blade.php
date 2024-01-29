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
    <div class="row">
        <div class="col-10 offset-1 d-flex justify-content-center">
            @if($subscription->ends_at !==NULL)
            <div>
                <h2 class="text-center">有料会員再開</h2>
                <p class="text-center" style="font-size:16px;"> 現在、あなたは有料会員プランを停止中です。<br>再開しますか？</p>
                <form method="POST" action="{{route('stripe.resume')}}" class="text-center">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg mt-2">再開する</button>
                </form>
            </div>
            @else
            <div>
                <h2 class="text-center">有料会員解約</h2>
                <p class="text-center" style="font-size:20px; font-weight:bold;"> 現在、あなたは有料会員です。<br>有料会員プランを停止しますか？</p>
                <form method="POST" action="{{route('stripe.cancel')}}" class="text-center">
                    @csrf
                    <button type="button" data-bs-toggle="modal" data-bs-target="#unsubscriptionModal" class="btn btn-danger btn-lg mt-2">退会する</button>
                    <div class="modal fade" id="unsubscriptionModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="unsubscriptionModalToggleLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="unsubscriptionModalToggleLabel" style="font-size:20px; font-weight:bold;">本当に有料会員プランを停止しますか？</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                    <button type="submit" class="btn btn-danger">退会</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
    @endsection
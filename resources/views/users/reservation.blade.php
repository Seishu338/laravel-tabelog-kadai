@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <span>
                <a href="{{ route('mypage') }}">マイページ</a> > 予約履歴
            </span>
            <h2 class="mt-3 mb-3">予約履歴</h2>

            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">店名</th>
                        <th scope="col">予約日</th>
                        <th scope="col">予約時間</th>
                        <th scope="col">人数</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @if($reservations->isEmpty())
                    <td colspan="5">
                        <h3>現在、予約はありません</h3>
                    </td>
                    @endif
                    @foreach($reservations as $reservation)
                    <tr>
                        <td>{{$reservation->restaurant->name}}</td>
                        <td>{{$reservation->reservations_date->format('Y年m月d日')}}</td>
                        <td>{{$reservation->reservations_time->format('H:i')}}</td>
                        <td>{{$reservation->number}}人</td>
                        <td class="text-center">
                            <form action="{{ route('reservation.destroy', $reservation) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
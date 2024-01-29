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
            <div class="table-responsive-md">
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
                            <h3>現在、予約はありません。</h3>
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
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{$reservation->id}}" class="btn btn-danger">削除</button>
                                    <div class="modal fade" id="deleteModal{{$reservation->id}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalToggleLabel{{$reservation->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalToggleLabel{{$reservation->id}}">予約を削除しますか？</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                                    <button type="submit" class="btn btn-danger">削除</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
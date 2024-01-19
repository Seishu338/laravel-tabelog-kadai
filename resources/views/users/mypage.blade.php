 @extends('layouts.app')
 
 @section('content')

 <div class="container d-flex justify-content-center mt-3">
    <div clasa="row">
     <div class="col-12 text-center">
       <h2>マイページ</h2>
     </div>
     <hr>
     <div class="col-10 offset-1 py-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">会員情報編集</h3>
                        <p class="card-text my-1">アカウント情報の編集</p>
                    </div>
                    <div class="card-footer text-center py-0">
                      <a href="{{route('mypage.edit')}}" class="btn">編集</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">パスワード変更</h3>
                        <p class="card-text my-1">パスワードを変更します</p>
                    </div>
                    <div class="card-footer text-center py-0">
                      <a href="{{route('mypage.edit_password')}}" class="btn">変更</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">お気に入り一覧</h3>
                        <p class="card-text my-1">お気に入りを確認できます</p>
                    </div>
                    <div class="card-footer text-center py-0">
                      <a href="" class="btn">一覧</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">予約履歴</h3>
                        <p class="card-text my-1">予約履歴を確認できます</p>
                    </div>
                    <div class="card-footer text-center py-0">
                      <a href="" class="btn">一覧</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">有料会員</h3>
                        <p class="card-text my-1">有料会員に変更します</p>
                    </div>
                    <div class="card-footer text-center py-0">
                      <a href="" class="btn">登録</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">有料会員解約</h3>
                        <p class="card-text my-1">有料会員を解約します</p>
                    </div>
                    <div class="card-footer text-center py-0">
                      <a href="" class="btn">解約</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
 @endsection
        
@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-5">
             <span>
                 <a href="{{ route('mypage') }}">マイページ</a> > パスワードの変更
             </span>
 
             <h2 class="mt-3 mb-3">パスワードの変更</h2>
             <hr>
 
             <form method="POST" action="{{ route('mypage.update_password') }}">
                 @csrf
                 <input type="hidden" name="_method" value="PUT">
                 <div class="form-group">
                     <div class="d-flex justify-content-between">
                         <label for="password" class="text-md-left">新しいパスワード</label>
                     </div>
                     <div>
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required autocomplete="new_password">
                         @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                         @enderror
                     </div>
                 </div>
                 <br>
 
                 <div class="form-group">
                     <div class="d-flex justify-content-between">
                         <label for="password-confirm" class="text-md-left">確認用</label>
                     </div>
                     <div>
                         <input id="password-confirm" type="password" class="form-control" name="password_confirm" required autocomplete="passowrd_confirm">
                     </div>
                 </div>
                 <div class="text-danger">
                 @if (session('flash_message'))
                     <p>{{ session('flash_message') }}</p>
                 @endif
                 </div>
                 <br>
 
                 <hr>
                 <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 w-25">
                        パスワード更新
                    </button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 @endsection
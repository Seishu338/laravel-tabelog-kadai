<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('top.index');
});

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite')->middleware(['StripeMiddleware']);
    Route::get('users/mypage/reservation', 'reservation')->name('mypage.reservation')->middleware(['StripeMiddleware']);
    Route::get('users/mypage/unsubscription', 'unsubscription')->name('mypage.unsubscription')->middleware(['StripeMiddleware']);
});

Route::controller(ReviewController::class)->group(function () {
    Route::get('reviews', 'create')->name('reviews.create')->middleware(['StripeMiddleware']);;
    Route::post('reviews', 'store')->name('reviews.store')->middleware(['StripeMiddleware']);;
});

Auth::routes(['verify' => true]);
Route::resource('restaurants', RestaurantController::class)->middleware(['auth', 'verified']);
Route::get('restaurants/{restaurant}/favorite', [RestaurantController::class, 'favorite'])->name('restaurants.favorite')->middleware(['StripeMiddleware']);;
Route::post('restaurants/reservation', [ReservationController::class, 'store'])->name('restaurants.reservation')->middleware(['StripeMiddleware']);;
Route::delete('restaurants/reservation/{reservation}', [ReservationController::class, 'destroy'])->name('reservation.destroy');


Route::get('/subscription', function () {
    return view('subscription', ['intent' => auth()->user()->createSetupIntent()]);
})->middleware(['auth'])->name('subscription');


Route::post('/user/subscribe', function (Request $request) {
    $request->user()->newSubscription(
        'default',
        'price_1Ob19NLwuQueWUBubWsAWQRF'
    )->create($request->paymentMethodId);

    return redirect('/');
})->middleware(['auth'])->name('subscribe.post');

Route::post('/subscription/cancel', function () {
    $user = Auth::user();
    $user->subscription('default')->cancel();
    return to_route('mypage');
})->name('stripe.cancel');

Route::post('/subscription/resume', function () {
    $user = Auth::user();
    $user->subscription('default')->resume();
    return to_route('mypage');
})->name('stripe.resume');

<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {

        $reservation = new Reservation();

        $reservation->restaurant_id = $request->input('restaurant_id');
        $reservation->user_id = Auth::user()->id;
        $reservation->reservations_time = $request->input('reservations_time');
        $reservation->reservations_date = $request->input('reservations_date');
        $reservation->number = $request->input('number');
        $reservation->save();

        return to_route('mypage.reservation');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return back();
    }
}

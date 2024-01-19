<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function create(Request $request)
    {
        $restaurant=$request->restaurant;
        return view('reviews.create',['restaurant'=>$restaurant]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' =>'required'
        ]);

        $review=new Review();
        $review->content=$request->input('content');
        $review->user_id=Auth::user()->id;
        $review->restaurant_id=$request->input('restaurant_id');
        $review->save();

        return to_route('restaurants.show',['restaurant' =>$review->restaurant_id]);
    }


   
}

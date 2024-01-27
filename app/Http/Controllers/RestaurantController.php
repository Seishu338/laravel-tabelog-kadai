<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Day;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    public function favorite(Restaurant $restaurant)
    {
        Auth::user()->togglefavorite($restaurant);

        return back();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->input('search');
        $category_id =  $request->input('category_id');
        $sort = $request->sort;

        $query = Restaurant::query();

        if (!empty($search)) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }

        if ($sort == 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort == 'row') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'score') {
            $query->orderBy('average_score', 'desc');
        } else {
            $query->orderBy('id', 'asc');
        }

        $restaurants = $query->paginate(15);

        $categories = Category::all();

        return view('restaurants.index', compact('restaurants', 'search', 'categories', 'category_id'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $reviews = $restaurant->reviews()->get();
        $average = $restaurant->average_score;
        $staravg = round($average * 2) / 2;

        $now = Carbon::now();
        $dt_future = Carbon::now()->addMonths(1);
        $periods = CarbonPeriod::create($now, $dt_future)->days();
        $selects = [];
        foreach ($periods as $value) {
            $selects[] = $value;
        }

        $start = Carbon::createFromTimeString($restaurant->starting_time);
        $end = Carbon::createFromTimeString($restaurant->ending_time)->subMinute(30);
        $periods2 = CarbonPeriod::create($start, $end)->minutes(30);
        $selects2 = [];
        foreach ($periods2 as $value) {
            $selects2[] = $value;
        }


        foreach ($restaurant->closing_days as $closing_day) {
            $day_ids[] = $closing_day->pivot->day_id;
        }

        return view('restaurants.show', compact('restaurant', 'reviews', 'staravg', 'selects', 'selects2', 'day_ids', 'average'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
}

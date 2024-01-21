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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $days = Day::all();
        return view('restaurants.create', compact('categories', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = new Restaurant();
        $restaurant->category_id = $request->input('category_id');
        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->starting_time = $request->input('starting_time');
        $restaurant->ending_time = $request->input('ending_time');
        $restaurant->price = $request->input('price');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->address = $request->input('address');
        $restaurant->phone = $request->input('phone');
        $restaurant->save();

        $restaurant->closing_days()->sync($request->input('day_ids'));

        return to_route('restaurants.index');
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
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();
        $days = Day::all();

        return view('restaurants.edit', compact('restaurant', 'categories', 'days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant->category_id = $request->input('category_id');
        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->starting_time = $request->input('starting_time');
        $restaurant->ending_time = $request->input('ending_time');
        $restaurant->price = $request->input('price');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->address = $request->input('address');
        $restaurant->phone = $request->input('phone');
        $restaurant->update();

        $restaurant->closing_days()->sync($request->input('day_ids'));

        return to_route('restaurants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return to_route('restaurants.index');
    }
}

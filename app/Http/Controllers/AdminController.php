<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.adminpage');
    }

    public function restaurant()
    {
        $restaurants = Restaurant::all();

        return view('admin.restaurant', compact('restaurants'));
    }

    public function user()
    {
        $users = User::all();

        return view('admin.user', compact('users'));
    }

    public function category()
    {
        $categories = Category::all();

        return view('admin.category', compact('categories'));
    }
}

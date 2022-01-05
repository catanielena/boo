<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Cuisine;
use App\Food;
use App\Order;

class HomeController extends Controller
{
    public function index() {

        $user = Auth::user();
        $foods = $user->foods;
        return view('admin.home', compact('foods', 'user'));
    }
}

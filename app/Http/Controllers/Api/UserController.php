<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{  
    public function index() 
    {
        $user = User::with(['cuisines'])->get();

        if( $user ) {
            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
        }
    }
    public function filter($cuisineId)
    {
        if ($cuisineId == 'all') {
            $users = User::all();
        } else {
            $users = User::whereHas('cuisines', function($query) use ($cuisineId) {
                $query->where('cuisine_id', $cuisineId);
            })
            ->get();
        }
        foreach ($users as $user) {
            $cuisines = [];
            $cuisines = $user->cuisines;
            $user->cuisines = $cuisines;
        };
        if($users) {
            return response()->json([
                'success' => true,
                'data' => $users,
            ]);
        }
    }   

    public function show($slug)
    {
        // $user = User::where('slug', $slug)->with('foods')->first();
        $user = User::where('slug', $slug)->with('foods')->firstOrFail();
        if( $user ) {
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        }

        return response()->json([
            'success' => false,
            'data' => ''
        ]);
    }
}


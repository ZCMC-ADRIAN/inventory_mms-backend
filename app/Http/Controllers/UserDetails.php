<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserDetails extends Controller
{
    public function user_details(Request $request){
        $user = $request->user();
        return response()->json($user);
    }
}

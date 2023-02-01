<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SignUp extends Controller
{
    public function SignUp(Request $request)
    {
        try {
            if (DB::table('users')->select('*')->where('email', $request->email)->count() < 1) {
                $user = new User();
                $user->firstname = $request->fname;
                $user->lastname = $request->lname;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();

                return response()->json([
                    'status' => 1
                ]);
            } else {
                return response()->json([
                    'status' => 2
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function Login(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['status' => 0]);
            }
            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['status' => 1]);
            }

            return response()->json([
                'status' => 2,
                // $response
                'token' => $user->createToken('auth_token')->plainTextToken,
                'token_type' => 'Bearer'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }
        return response()->json([
            'status' => 1
        ]);
    }
}

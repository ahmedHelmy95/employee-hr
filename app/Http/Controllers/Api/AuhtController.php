<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuhtController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required|exists:users,email',
            'password' => 'required',
        ]); 
        $user = Employee::where('email', request()->email)->first();
        if (!$user&& !Hash::check(request()->password, $user->password)) { 
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        Auth::login($user); 
        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);

    }
}

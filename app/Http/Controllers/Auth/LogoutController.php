<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogoutController extends Controller
{
    use AuthenticatesUsers;

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->delete();
        }
        auth('web')->logout();

        return response()->json(null, 200);
    }
}

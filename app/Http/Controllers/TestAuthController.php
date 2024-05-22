<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class TestAuthController extends Controller
{
    public function student()
    {
        $user = User::find("390201100321");
        Auth::login($user);
        return redirect()->route('first-page');
    }

    public function employee()
    {
        $user = User::find("3901511005");
        Auth::login($user);
        return redirect()->route('first-page');
    }
}

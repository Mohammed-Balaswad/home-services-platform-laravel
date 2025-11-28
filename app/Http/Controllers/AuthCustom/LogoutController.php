<?php

namespace App\Http\Controllers\AuthCustom;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}

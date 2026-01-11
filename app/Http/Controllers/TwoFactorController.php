<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function index(){

        $user = Auth::user();
        return view('Front.auth.two-factor-authentication', compact('user'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(\App\Providers\RouteServiceProvider::HOME)
            : view('auth/account-register-check-email', compact('user'));

        //    if($request->user()->hasVerifiedEmail())
        //    {
        //        return redirect()->intended(\App\Providers\RouteServiceProvider::HOME);
        //    }
        //
        //    return view('auth/account-register-check-email');

    }
}
















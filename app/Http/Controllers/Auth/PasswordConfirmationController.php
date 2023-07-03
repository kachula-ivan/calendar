<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordConfirmationController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('main/confirm-password', compact('user'));

    }

    public function store(Request $request)
    {
       if (! Hash::check($request->password, $request->user()->password))
       {
            return back()->withErrors([
                'password' => ['Ви ввели не правильний пароль']
            ]);
       }

       $request->session()->passwordConfirmed();

       return redirect()->intended();
    }
}
















<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth/account-register');
    }

    public function create_with_email()
    {
        return view('auth/account-register-email');
    }

    public function store_with_email(Request $request)
    {
        $request->validate([
            'name' => ['string'],
            'surname' => ['string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required',  'min:8', 'confirmed']
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}

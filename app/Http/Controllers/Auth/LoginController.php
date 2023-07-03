<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function create_with_email()
    {
        return view('auth/account-login');
    }

    public function store_with_email(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'all' => 'Ви вказали неправильний логін або пароль.'
            ]);

//            return back()
//                ->withInput()
//                ->withErrors([
//                    'all' => 'Ви вказали неправильний логін або пароль.'
//                ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
















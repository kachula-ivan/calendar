<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $today = Carbon::now();
            $SocialUser = Socialite::driver($provider)->user();
//            if (User::where('email', $SocialUser->getEmail())->exists()) {
//                return redirect()->route('login')->withErrors(['all' => 'Ця пошта вже зайнята!']);
//            }

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $SocialUser->id,
            ])->first();
            $user_name = $SocialUser->getName();
            if ($user_name === null)
            {
                $user_name = $SocialUser->getNickname();
            }
            if (!$user) {
                $user = User::updateOrCreate(
                    [
                        'name' => $user_name,
                        'email' => $SocialUser->getEmail(),
                        'avatar' => $SocialUser->getAvatar(),
                        'provider_id' => $SocialUser->getId(),
                        'provider' => $provider,
                        'provider_token' => $SocialUser->token,
                    ]
                );
            }
            $user->email_verified_at = $today;
            $user->save();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['all' => 'Ця пошта вже зайнята!']);
        }

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}

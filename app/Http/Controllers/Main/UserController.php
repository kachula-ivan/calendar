<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function account()
    {
        $user = Auth::user();

        if ($user->birthday) {
            $birthdayParts = explode('-', $user->birthday);
            $year = isset($birthdayParts[0]) ? (int)$birthdayParts[0] : null;
            $month = isset($birthdayParts[1]) ? (int)$birthdayParts[1] : null;
            $day = isset($birthdayParts[2]) ? (int)$birthdayParts[2] : null;
        } else {
            $year = null;
            $month = null;
            $day = null;
        }

        return view('main.account', compact('user', 'year', 'month', 'day'));
    }

    function getZodiacalSign($month, $day)
    {
        if ($month === null || $day === null) {
            return null;
        }

        $signs = array("capricorn", "aquarius", "pisces", "aries", "taurus", "gemini", "cancer", "leo", "virgo", "libra", "scorpio", "sagittarius");
        $signsstart = array(1 => 21, 2 => 20, 3 => 20, 4 => 20, 5 => 20, 6 => 20, 7 => 21, 8 => 22, 9 => 23, 10 => 23, 11 => 23, 12 => 23);
        return $day < $signsstart[$month] ? $signs[$month - 1] : $signs[$month % 12];
    }
}

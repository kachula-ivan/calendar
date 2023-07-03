<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile($user_id)
    {
        $user = Auth::user();
        $colors = Color::all();
        $groups = Group::all();
        $profile_user = User::where('id', $user_id)->first();

        if ($profile_user->birthday) {
            $birthdayParts = explode('-', $profile_user->birthday);
            $year = isset($birthdayParts[0]) ? (int)$birthdayParts[0] : null;
            $month = isset($birthdayParts[1]) ? (int)$birthdayParts[1] : null;
            $day = isset($birthdayParts[2]) ? (int)$birthdayParts[2] : null;
        } else {
            $year = null;
            $month = null;
            $day = null;
        }

        if (!$profile_user)
        {
            abort(404);
        }

        return view('friends/profile', compact('user', 'colors', 'groups', 'profile_user', 'year', 'month', 'day'));
    }
}

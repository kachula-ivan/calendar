<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('friends/friends', compact('user'));
    }

    public function requests()
    {
        $user = Auth::user();
        $requests = Auth::user()->friendsRequests();

        return view('friends/requests', compact('user', 'requests'));
    }

    public function getAdd($user_id)
    {
        $user_add = User::where('id', $user_id)->first();

        if (!$user_add)
        {
            return redirect()->route('friends');
        }

        if (Auth::user()->hasFriendRequestReceived($user_add) || $user_add->hasFriendRequestReceived(Auth::user()))
        {
            return redirect()->route('profile', ['user_id' => $user_add])
                             ->with('status', 'Користувачу надіслано запит на дружбу.');
        }

        if (Auth::user()->id == $user_id)
        {
            return redirect()->route('friends');
        }

        if (Auth::user()->isFriendWith($user_add))
        {
            return redirect()->route('profile', ['user_id' => $user_add])
                             ->with('status', 'Користувач вже ваш друг!');
        }

        Auth::user()->addFriend($user_add);

        return redirect()->route('profile', ['user_id' => $user_add])
                         ->with('status', 'Користувачу надіслано запит на дружбу');

    }

    public function getAccept($user_id)
    {
        $user_accept = User::where('id', $user_id)->first();

        if (!$user_accept)
        {
            return redirect()->route('friends');
        }

        if (!Auth::user()->hasFriendRequestReceived($user_accept))
        {
            return redirect()->route('friends');
        }

        Auth::user()->acceptFriendRequest($user_accept);

        return redirect()->route('profile', ['user_id' => $user_accept])
            ->with('status', 'Ви прийняли запит на дружбу');
    }

    public function deleteFriend($user_id)
    {
        $user_delete = User::where('id', $user_id)->first();

        if (!$user_delete)
        {
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user_delete);

        return redirect()->back()->with('status', 'Користувач видаланеий із списку друзів.');
    }
}

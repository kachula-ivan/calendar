<?php

namespace App\Http\Controllers\Calender;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventsInvites;
use App\Models\MessagesTelegram;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventsInvitesController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'title' => ['required', 'string', 'max:100']
        ]);

        $start_datetime = Carbon::parse($request->start_date . ' ' . $request->start_time);
        if ($request->end_date) {
            $end_datetime = Carbon::parse($request->end_date . ' ' . $request->end_time);
            $end_datetime->addSeconds(1);
        } else {
            $end_datetime = null;
        }

        $start_datetime = $request->start_date . ' ' . $request->start_time;
        $end_datetime = $request->end_date ? $request->end_date . ' ' . $request->end_time : null;

        EventsInvites::create([
            'title' => $request->title,
            'user_id' => $user->id,
            'friend_id' => $request->friend_id,
            'start_date' => $start_datetime,
            'end_date' => $end_datetime,
            'color' => $request->color,
            'group' => $request->group,
        ]);

        return response()->json(['message' => 'Event created successfully']);
    }

    public function eventsInvites()
    {
        $user = Auth::user();
        $invites = EventsInvites::with('user')->where('friend_id', $user->id)->get();
        return view('friends/invites', compact('user', 'invites'));

    }

    public function invitesDecline(Request $request, EventsInvites $invite_id)
    {
        $invite_id->delete();

        return redirect()->back()->with('status', "Ви відхилили запрошення.");;
    }

    public function invitesAccept(Request $request, EventsInvites $invite_id)
    {

        Event::create([
            'title' => $invite_id->title,
            'user_id' => $invite_id->user_id,
            'start_date' => $invite_id->start_date,
            'end_date' => $invite_id->end_date,
            'color' => $invite_id->color,
            'group' => $invite_id->group,
        ]);

        Event::create([
            'title' => $invite_id->title,
            'user_id' => $invite_id->friend_id,
            'start_date' => $invite_id->start_date,
            'end_date' => $invite_id->end_date,
            'color' => $invite_id->color,
            'group' => $invite_id->group,
        ]);

        $invite_id->delete();

        return redirect()->back()->with('status', "Ви прийняли запрошення. Подія з'явилась у вас в календарі.");
    }
}

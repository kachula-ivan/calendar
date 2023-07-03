<?php

namespace App\Http\Controllers\Calender;

use App\Http\Controllers\Controller;
use App\Jobs\EndEventJob;
use App\Jobs\StartEventJob;
use App\Mail\StartEvent;
use App\Models\Color;
use App\Models\Event;
use App\Models\Group;
use App\Models\MessagesTelegram;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CalendarController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        $groups = Group::all();
        $user = Auth::user();
        $events = $user->events()->get();
        $formattedEvents = [];

        foreach ($events as $event) {
            $formattedEvents[] = [
                'id' => $event->id,
                'title' => $event->title,
                'user_id' => $user->id,
                'done' => $event->done,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'color' => $event->color ? Color::find($event->color)->color : null,
                'borderColor' => $event->group ? Group::find($event->group)->color : null,
                'group' => $event->group,
                'freq' => $event->freq,
                'interval' => $event->interval,
                'byweekday' => $event->byweekday,
                'duration' => $event->duration,
                'dtstart' => $event->dtstart,
                'until'=> $event->until,
            ];
        }

        return view('main/dashboard', ['events' => $formattedEvents, 'user' => $user, 'colors' => $colors, 'groups' => $groups]);
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'title' => ['required', 'string', 'max:100']
        ]);

        $start_datetime = Carbon::parse($request->start_date . ' ' . $request->start_time);
        if ($request->end_date)
        {
            $end_datetime = Carbon::parse($request->end_date . ' ' . $request->end_time);
            $end_datetime->addSeconds(1);
        }
        else
        {
            $end_datetime = null;
        }

        dispatch(new StartEventJob($user->email, $user->name, $request->title, $start_datetime, $end_datetime));
        dispatch(new EndEventJob($user->email, $user->name, $request->title, $start_datetime, $end_datetime));

        $booking = Event::create([
            'title' => $request->title,
            'user_id' => $user->id,
            'start_date' => $start_datetime,
            'end_date' => $end_datetime,
            'color' => $request->color,
            'group' => $request->group,
            'freq' => $request->freq,
            'interval' => $request->interval,
            'byweekday' => $request->byweekday,
            'duration' => $request->duration,
            'dtstart' => $request->dtstart,
            'until' => $request->until,
        ]);

        $event_id = $booking->id;

        if ($user->telegram_id){
            MessagesTelegram::create([
                'event_id' => $event_id,
                'telegram_id' => $user->telegram_id,
                'title' => $request->title,
                'start_date' => $start_datetime,
                'end_date' => $end_datetime,
            ]);
        }



        return response()->json([
            'id' => $booking->id,
            'user_id' => $user->id,
            'start' => $start_datetime,
            'end' => $end_datetime,
            'title' => $booking->title,
            'color' => $booking->color,
            'group' => $booking->group,
            'freq' => $booking->freq,
            'interval' => $booking->interval,
            'byweekday' => $booking->byweekday,
            'duration' => $booking->duration,
            'dtstart' => $booking->dtstart,
            'until'=> $booking->until,
        ]);

    }

    public function update(Request $request, $id)
    {
        $booking = Event::find($id);
        if (! $booking)
            return response()->json([
               'error' => 'Unable to locate the event'
            ], 404);

        $start_datetime = Carbon::parse($request->start_date . ' ' . $request->start_time);
//        $start_datetime->subHour(3);
//        $end_datetime->subHour(3);
        if ($request->end_date)
        {
            $end_datetime = Carbon::parse($request->end_date . ' ' . $request->end_time);
            $end_datetime->addSeconds(1);
            if ($start_datetime > $end_datetime)
            {
                return response()->json([
                    'error' => 'Не можливо щоб кінцева дата була раніше стартової!'
                ], 404);
            }
        }
        else
        {
            $end_datetime = null;
        }
        $booking->update([
            'title' => $request->title,
            'start_date' => $start_datetime,
            'end_date' => $end_datetime,
            'color' => $request->color,
            'group' => $request->group,
            'freq' => $request->freq,
            'interval' => $request->interval,
            'duration' => $request->duration,
            'byweekday' => $request->byweekday,
            'dtstart' => $request->dtstart,
            'until' => $request->until,
        ]);

        try {
            $message = MessagesTelegram::where('event_id', $id)->first();
            $message->update([
                'title' => $request->title,
                'start_date' => $start_datetime,
                'end_date' => $end_datetime,
                'start_message' => 0,
                'end_message' => 0,
            ]);
            return response()->json('EventBack updated');
        }
        catch (\Throwable $e) {
            return response()->json('EventBack updated');
        }

    }


    public function update_draggable(Request $request, $id)
    {
        $booking = Event::find($id);
        if (! $booking)
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);

        $start_datetime = Carbon::parse($request->start_date . ' ' . $request->start_time);
        if ($request->end_date != 'Invalid date')
        {
            $end_datetime = Carbon::parse($request->end_date . ' ' . $request->end_time);
            $end_datetime->addSeconds(1);
            if ($start_datetime > $end_datetime)
            {
                return response()->json([
                    'error' => 'Не можливо щоб кінцева дата була раніше стартової!'
                ], 404);
            }
        }
        else
        {
            $end_datetime = null;
        }

        $booking->update([
            'title' => $request->title,
            'start_date' => $start_datetime,
            'end_date' => $end_datetime,
        ]);
        try {
            $message = MessagesTelegram::where('event_id', $id)->first();
            $message->update([
                'title' => $request->title,
                'start_date' => $start_datetime,
                'end_date' => $end_datetime,
                'start_message' => 0,
                'end_message' => 0,
            ]);
            return response()->json('EventBack updated');
        }
        catch (\Throwable $e) {
            return response()->json('EventBack updated');
        }
    }

    public function update_done(Request $request, $id)
    {
        $booking = Event::find($id);
        if (! $booking)
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);

        $booking->update([
            'done' => $request->input('done', 1),
        ]);
        return response()->json('EventBack updated');
    }


    public function destroy($id)
    {
        $booking = Event::find($id);
        if (! $booking)
        {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        $booking->delete();

        return $id;
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ResendVerifyEmailJob;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail())
        {
            return redirect()->intended(\App\Providers\RouteServiceProvider::HOME);
        }

        dispatch(new ResendVerifyEmailJob($request->user()));

        return back()->with('status', 'Verification link sent!');
    }

}
//Exception: Job is incomplete class: {"__PHP_Incomplete_Class_Name":"App\\Jobs\\VerifyEmailJob"} in E:\Programs\OSPanel\domains\test-ITSpace\vendor\laravel\framework\src\Illuminate\Queue\CallQueuedHandler.php:117

//Error: Call to a member function sendEmailVerificationNotification() on null in E:\Programs\OSPanel\domains\test-ITSpace\app\Jobs\ResendVerifyEmailJob.php:29











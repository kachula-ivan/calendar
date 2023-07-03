<?php

namespace App\Jobs;

use App\Mail\EndEvent;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EndEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $name;
    public $title;
    public $end_datetime;
    public $start_datetime;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $name, $title, $start_datetime, $end_datetime)
    {
        $this->email = $email;
        $this->name = $name;
        $this->title = $title;
        $this->start_datetime = $start_datetime;
        $this->end_datetime = $end_datetime;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $now = Carbon::parse(now());
        $end = Carbon::parse($this->end_datetime);
        if (!$this->end_datetime or $this->end_datetime == null or $this->end_datetime == ''
        )
        {
            return;
        }
        else
        {
            $nowInSeconds = $now->timestamp;
            $startInSeconds = $end->timestamp;
            $when = $startInSeconds - $nowInSeconds;
            $when = $when - 10800;
            Mail::to($this->email)
                ->later($when, new EndEvent($this->name, $this->title, $this->start_datetime, $this->end_datetime));
        }
    }
}

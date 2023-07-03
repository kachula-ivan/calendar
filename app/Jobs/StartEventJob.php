<?php

namespace App\Jobs;
use App\Mail\StartEvent;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class StartEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $name;
    public $title;
    public $start_datetime;
    public $end_datetime;

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
        $start = Carbon::parse($this->start_datetime);
        $nowInSeconds = $now->timestamp;
        $startInSeconds = $start->timestamp;
        $when = $startInSeconds - $nowInSeconds;
        $when = $when - 10800;
        Mail::to($this->email)
            ->later($when, new StartEvent($this->name, $this->title, $this->start_datetime, $this->end_datetime));
    }
}

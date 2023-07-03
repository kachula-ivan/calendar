<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EndEvent extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $title;
    public $end_datetime;
    public $start_datetime;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $title, $start_datetime, $end_datetime)
    {
        $this->name = $name;
        $this->title = $title;
        $this->start_datetime = $start_datetime;
        $this->end_datetime = $end_datetime;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'End Event',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.end_event',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

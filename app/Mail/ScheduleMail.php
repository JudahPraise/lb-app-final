<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleMail extends Mailable
{
    use Queueable, SerializesModels;
    public $job, $link, $date, $name, $time;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job, $link, $date, $name, $time)
    {
        $this->job = $job;
        $this->link = $link;
        $this->date = $date;
        $this->name = $name;
        $this->time = $time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('interview.email')
        ->with('job', $this->job)
        ->with('link', $this->link)
        ->with('date', $this->date)
        ->with('name', $this->name)
        ->with('time', $this->time);
    }
}

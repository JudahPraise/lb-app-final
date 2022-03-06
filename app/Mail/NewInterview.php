<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewInterview extends Mailable
{
    use Queueable, SerializesModels;

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
        return $this->markdown('interview.new')
        ->with('job', $this->job)
        ->with('link', $this->link)
        ->with('date', $this->date)
        ->with('name', $this->name)
        ->with('time', $this->time);
    }
}

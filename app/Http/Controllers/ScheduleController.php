<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Schedule;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Mail\ScheduleMail;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
{
    //

    public function index($id, $reg_id)
    {

        $position = Position::where('id','=',$id)->first();
        $registration = Registration::where('id','=',$reg_id)->first();
        $schedules = Schedule::where('position_id','=',$id)->get();

        
        //dd($schedules);
        return view('guest-page.schedule-page', compact('position', 'registration','schedules'),);
        
    }


    public function getInterview($id, $reg_id, $sched_id)
    {
        $position = Position::where('id','=',$id)->first();
        $registration = Registration::where('id','=',$reg_id)->first();
        $schedule = Schedule::where('id','=',$sched_id)->first();

        $job = $position->position;
        $link = $schedule->link;
        $date = $schedule->getDate();
        $name = $registration->firstname;
        $time = $schedule->getTime();

        Mail::to($registration->email_address)->send(new ScheduleMail($job, $link, $date, $name, $time));
       
        return redirect()->route('thankyou.index');
        
    }

    public function thankyou()
    {
        return view('guest-page.thankyou-page');
    }

}

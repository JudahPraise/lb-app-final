<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Schedule;
use App\Mail\NewInterview;
use App\Mail\ScheduleMail;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\ElapsedScheduleMail;
use Illuminate\Support\Facades\Mail;

class ElapsedInterview extends Controller
{
    public function notify($id, $reg_id)
    {
        $position = Position::where('id','=',$id)->first();
        $registration = Registration::where('id','=',$reg_id)->first();
        $user = User::first();

        // dd($user);

        $job = $position->position;
        $name = $registration->getFullname();
        $message = "Request for schedule of interview.";

        $registration->update([
            'interview_status' => "Send Schedule"
        ]);

        Result::where('registration_id','=',$reg_id)->update([
            'schedule_id' => $sched_id
        ]);

        Mail::to($user->email)->send(new ElapsedScheduleMail($message,$name,$job));

       
        return redirect()->route('thankyou.notify');
    }

    public function sendSchedule(Request $request, $id)
    {
        $registration = Registration::where('id','=',$id)->with('result')->first();
        $now = Carbon::now()->format('Y-m-d');

        if($request->date > $now)
        {  
            $schedule = Schedule::create([
                'position_id' => $registration->position_id,
                'date' => $request->date,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
                'link' => $request->link
            ]);

            $registration->result->update([
                'schedule_id' => $schedule->id,
            ]);
    
            $registration->update([
                'interview_status' => "Waiting for Interview"
            ]);
    
            $job = $registration->getPosition();
            $link = $schedule->link;
            $date = $schedule->getDate();
            $name = $registration->firstname;
            $time = $schedule->getTime();
    
            Mail::to($registration->email_address)->send(new NewInterview($job, $link, $date, $name, $time));
    
            return redirect()->back()->with('success', 'New schedule sent');
        }
        
        return redirect()->back()->with('delete', 'Invalid date!');
    

    }

    public function sendSecondSchedule(Request $request, $id)
    {
        $registration = Registration::where('id','=',$id)->with('result')->first();
        $registration = Registration::where('id','=',$id)->with('result')->first();
        $now = Carbon::now()->format('Y-m-d');

        if($request->date > $now)
        { 
            $schedule = Schedule::create([
                'position_id' => $registration->position_id,
                'date' => $request->date,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
                'link' => $request->link
            ]);

            $registration->result->update([
                'schedule_id' => $schedule->id,
            ]);
    
            $registration->update([
                'interview_status' => "Waiting for Interview"
            ]);
    
            $job = $registration->getPosition();
            $link = $schedule->link;
            $date = $schedule->getDate();
            $name = $registration->firstname;
            $time = $schedule->getTime();
    
            Mail::to($registration->email_address)->send(new SecondInterview($job, $link, $date, $name, $time));
    
            return redirect()->back()->with('success', 'New schedule sent');
        }
        
        return redirect()->back()->with('delete', 'Invalid date!');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Schedule;
use App\Models\Registration;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //

    public function index($id, $reg_id)
    {

        $position = Position::where('id','=',$id)->first();
        $registration = Registration::where('id','=',$reg_id)->first();
        $schedules = Schedule::where('position_id','=',$id)->get();

        
       // dd($schedule);
        return view('guest-page.schedule-page', compact('position', 'registration','schedules'));
        
    }
}

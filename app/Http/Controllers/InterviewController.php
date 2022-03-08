<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Schedule;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();
        $schedules = Schedule::with('position')->get();
        return view('interview.index', compact('positions','schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');

        if($request->date > $now)
        {  
            Schedule::create([
                'position_id' => $request->position_id,
                'date' => $request->date,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
                'link' => $request->link
            ]);

            return redirect()->back()->with('success', 'Schedule added!');        
        }
        
        return redirect()->back()->with('delete', 'Invalid date!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $now = Carbon::now()->format('Y-m-d');

        if($request->date > $now)
        {  
            Schedule::where('id','=',$id)->update([
                'position_id' => $request->position_id,
                'date' => $request->date,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
                'link' => $request->link
            ]);
        
            return redirect()->back()->with('update', 'Schedule updated!');
        }
        
        return redirect()->back()->with('delete', 'Invalid date!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Schedule::where('id','=',$id)->delete();
        return redirect()->back()->with('delete', 'Schedule deleted!');
    }

    public function updateStatus($id, $status){

        $newstatus = '';

        if($status == 'A777')
        {
            $newstatus = 'Passed';
        }
        else
        {
            $newstatus = 'Failed';
        }

        Registration::where('id','=',$id)->update([
            'interview_status' => $newstatus
        ]);

        return redirect()->back()->with('success', 'Registration status updated!');

    }
}

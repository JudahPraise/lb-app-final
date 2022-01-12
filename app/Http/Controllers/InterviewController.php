<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Schedule;
use Illuminate\Http\Request;

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
        Schedule::create([
            'position_id' => $request->position_id,
            'date' => $request->date,
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
            'link' => $request->link
        ]);

        return redirect()->back()->with('success', 'Schedule added!');
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
        Schedule::where('id','=',$id)->update([
            'position_id' => $request->position_id,
            'date' => $request->date,
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
            'link' => $request->link
        ]);

        return redirect()->back()->with('update', 'Schedule updated!');
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
}

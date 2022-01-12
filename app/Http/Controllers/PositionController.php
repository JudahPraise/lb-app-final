<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\SetSkill;
use Illuminate\Http\Request;
use App\Models\SetQualification;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();
        return view('position.index', compact('positions'));
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
        Position::create([
            'position' => $request->position,
            'department' => $request->department,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Position saved!');
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
        Position::where('id','=',$id)->update([
            'position' => $request->position,
            'department' => $request->department,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('update', 'Position updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SetQualification::where('position_id','=',$id)->delete();
        SetSkill::where('position_id','=',$id)->delete();
        Position::where('id','=',$id)->delete();
        return redirect()->back()->with('delete', 'Position deleted!');
    }
}

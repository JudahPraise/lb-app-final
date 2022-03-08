<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\SetQualification;
use App\Models\AddQualifications;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualifications = AddQualifications::all();
        $positions = Position::all();
        return view('qualification.index', compact('qualifications','positions'));
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
        
        AddQualifications::create([
            'title' => $request->title,
            'options' => $request->options,
            'tag' => $request->tag
        ]);

        return redirect()->back()->with('success', 'Qualification saved!');
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
        $qualification = AddQualifications::where('id','=',$id)->first();
        $positions = Position::all();
        return view('qualification.edit', compact('qualification','positions'));
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
        AddQualifications::where('id','=',$id)->update([
            'title' => $request->title,
            'options' => $request->options,
            'tag' => $request->tag
        ]);

        return redirect()->route('qualification.index')->with('update', 'Qualification udpated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SetQualification::where('qualification_id','=',$id)->delete();
        AddQualifications::where('id','=',$id)->delete();
        return redirect()->back()->with('delete', 'Qualification deleted!');
    }
}

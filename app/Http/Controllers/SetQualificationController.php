<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\SetQualification;
use App\Models\AddQualifications;
use Illuminate\Support\Facades\DB;

class SetQualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $position = Position::where('id','=',$id)->first();
        $qualifications = AddQualifications::where('tag','=',$position->position)->orWhere('tag','=','All')->get();

        return view('position.background_create', compact('position','qualifications'));
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
    public function store(Request $request, $id)
    {
        $position = Position::where('id','=',$id)->first();
        $qualifications = [];

        foreach ($request->position_id as $item => $key) {
            $qualifications[] = SetQualification::insert([
                'qualified_option' => $request->qualified_option[$item],
                'position_id' => $request->position_id[$item],
                'qualification_id' => $request->qualification_id[$item],
                'point' => $request->point[$item],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        // $research->authors()->saveMany($authors);

        return redirect()->route('setQualifcation.show', $id)->with('success', 'Qualification added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $position = Position::where('id','=',$id)->first();
        $qualified = SetQualification::where('position_id','=',$id)->with('qualification')->get();
        // dd($qualified);
        return view('position.background', compact('position','qualified'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setqualification = SetQualification::where('id','=',$id)->delete();
        return redirect()->back()->with('delete', 'Qualification deleted');
    }
}

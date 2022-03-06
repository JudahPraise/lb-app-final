<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Position;
use App\Models\Schedule;
use App\Models\SkillResult;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\QualificationResult;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passers = Result::with('registration','schedule')->get();
        $applicants = Registration::count();
        $positions = Position::all();
        return view('dashboard.index', compact('passers', 'positions', 'applicants'));
    }

    public function filter()
    {
        // $registration = Registration::where()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicant = Result::where('registration_id','=',$id)->with('registration')->first();
        $position = Position::where('id','=',$applicant->position_id)->first();
        $interview = Schedule::where('id','=',$applicant->schedule_id)->first();
        $qualification = QualificationResult::where('registration_id','=',$id)->first();
        $exam = SkillResult::where('registration_id','=',$id)->first();
        return view('dashboard.show', compact('applicant', 'position', 'qualification','exam','interview'));
    }

    public function download($id){
        $registration = Registration::where('id','=',$id)->first();
        return response()->download(storage_path("app/public/documents/{$registration->resume}"));
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
        Registration::where('id','=',$id)->delete();
        return redirect()->back()->with('delete', 'Record successfully deleted!');
    }
}

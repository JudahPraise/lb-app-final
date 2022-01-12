<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Position;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\SetQualification;
use App\Models\QualificationResult;

class ApplicantQualification extends Controller
{
    public function index($id, $reg_id)
    {
        $position = Position::where('id','=',$id)->first();
        $qualified = SetQualification::where('position_id','=',$id)->with('qualification')->get();
        $registration = Registration::where('id','=',$reg_id)->first();
        // dd($qualified);
        return view('guest-page.qualification-page', compact('position','qualified', 'registration'));
    }

    public function store(Request $request, $id, $reg_id)
    {
       $score = 0;
       $qualified_score = SetQualification::where('position_id','=',$id)->sum('point');
       $status = 'Underqualified';

       foreach($request->registration_id as $item => $key)
       {
            $score += $request->points[$item];
       }
       
       if($score == $qualified_score)
       {
           $status = 'Qualified';
       }
       elseif($score > $qualified_score)
       {
           $status = 'Overqualified';
       }

        QualificationResult::insert([
            'registration_id' => $reg_id,
            'points' =>  $score,
            'status' => $status
        ]);

       Result::create([
            'registration_id' => $reg_id,
            'position_id' => $id,
            'qualification' => $score,
            'exam' => 0,
            'schedule_id' => null,
       ]);

       return redirect()->route('applicant.skillstest', ['id' => $id, 'reg_id' => $reg_id]);

    }
}

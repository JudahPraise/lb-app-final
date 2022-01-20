<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Position;
use App\Models\SetSkill;
use App\Models\SkillResult;
use App\Models\Result;
use App\Models\Registration;
use App\Models\QualificationResult;
use Illuminate\Http\Request;
use App\Models\SkillTestForm;
use App\Models\SetQualification;

class SkillsTest extends Controller
{
    public function index($id, $reg_id)
    {
        $position = Position::where('id','=',$id)->first();
        $registration = Registration::where('id','=',$reg_id)->first();
        $skills = SetSkill::where('position_id','=',$position->id)->with('skills.questions.choices')->get();
        $answers = SkillTestForm::where('registration_id','=',$reg_id)->select('choice_id')->get();
        // dd($answers);
        return view('guest-page.exam-page', compact('position', 'registration','skills','answers'));
    }

    public function store(Request $request, $id, $reg_id)
    {
        $score = 0;
        $status = '';
        $skillTestForm = [];
        $qualified_score = SetSkill::where('skill_id','=',$request->skill_id)->select('points')->first();
        $skills = SetSkill::where('position_id','=',$id)->get();

        foreach($request->point as $item => $key)
        {
            $skillTestForm[] = SkillTestForm::create([
                'registration_id' => $reg_id,
                'skill_id' => $request->skill_id,
                'choice_id' => $request->choice_id[$item],
                'points' => $request->point[$item],
            ]);
        }

        foreach($request->point as $item => $key)
        {
             $score += $request->point[$item];
        }

        
        if($score >= $qualified_score->points)
        {
            $status = 'passed';
        }
        else
        {
            $status = 'failed';
        }

        SkillResult::create([
            'registration_id' => $reg_id,
            'skill_id' => $request->skill_id,
            'points' => $score,
            'status' => $status,
        ]);

        $answered = SkillResult::where('registration_id','=',$reg_id)->get();

        // dd($request->skill_id);
        
        if($skills->count() != $answered->count())
        {
            $answers = SkillTestForm::where([
               ['registration_id','=',$reg_id],
                ['skill_id','=',$request->skill_id]
            ])->get();

            return redirect()->back()->with(compact('answers'));
        }


        $examresult = SkillResult::where('registration_id','=',$reg_id)->sum('points');
        
        Result::where('registration_id','=',$reg_id)->update(['exam'=> $examresult,]);
        

        //Dito yung redirect pre ikaw na sa condition para mapractice ka haha


        $qualified_points = SetQualification::where('position_id','=',$id)->sum('point');
        $exam_points = SetSkill::where('position_id','=',$id)->sum('points');
        $results = Result::where('registration_id','=',$reg_id)->first();
        $position_count = Position::all()->count();
        $registration_count = Registration::where('id','=',$reg_id)->count();
        

        if($results->qualification < $qualified_points)
        {
            if($registration_count ===  $position_count)
            {
                dd('you reach maximum try');
            }
            return redirect()->route('other.position', ['id'=>$id, 'reg_id'=>$reg_id]);
        }

        return redirect()->route('interview.Schedule', ['id'=>$id, 'reg_id'=>$reg_id]);
    }
}

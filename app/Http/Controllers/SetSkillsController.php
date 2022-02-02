<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Choice;
use App\Models\Position;
use App\Models\Question;
use App\Models\SetSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SetSkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $position = Position::where('id','=',$id)->first();
        
        $skills = Skill::where('tag','=',$position->position)->orWhere('tag','=','All')->with('questions.choices')->get();
        // foreach($skills as $skill)
        // {
        //    foreach($skill->questions as $question)
        //    {
        //        foreach($question->choices as $choice)
        //        {
        //            dd($choice->choice);
        //        }
        //    }
        // }
        return view('position.skill_create', compact('position','skills'));
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
        $skills = [];

        foreach ($request->skill_id as $item => $key) {

            $total_points = Skill::where('id','=',$request->skill_id[$item])->first();

            $skills[] = ([
                'position_id' => $id,
                'skill_id' => $request->skill_id[$item],
                'points' =>  $total_points->total_points,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        SetSkill::insert($skills);
        

        return redirect()->route('setSkills.show', $id)->with('success', 'Skills added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $position = Position::where('id','=',$id)->first();
        $getSkills = SetSkill::where('position_id','=',$position->id)->with('skills.questions.choices')->get();
        // foreach($getSkills as $skill)
        // {
        //     dd($skill->skills);
        // }
        return view('position.skills', compact('position', 'getSkills'));
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
        SetSkill::where('id','=',$id)->delete();
        return redirect()->back()->with('delete', 'Skill deleted!');
    }
}

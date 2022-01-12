<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Choice;
use App\Models\Position;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AddQuestionController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       
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
        $question = Question::create([
            'skill_id' => $request->skill_id,
            'question' => $request->question
        ]);

        $choices = [];
        $points = 0;

        foreach ($request->choice as $item => $key) {
            $choices[] = ([
                'question_id' => $question->id,
                'choice' => $request->choice[$item],
                'points' => $request->points[$item],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $points += $request->points[$item];
        }

        $skill = Skill::where('id','=',$request->skill_id)->first();

        $current_points = $skill->total_points;

        $total_points = $current_points + $points;

        $skill->total_points = $total_points;
        $skill->update();

        Choice::insert($choices);
        
        return redirect()->back()->with('success', 'Question added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::where('id','=',$id)->with('choices')->first();
        $skill = Skill::where('id','=',$question->skill_id)->first();
        return view('skills.edit', compact('question','skill'));
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
        $question = Question::where('id','=',$id)->update([
            'skill_id' => $request->skill_id,
            'question' => $request->question
        ]);

        $choices = [];

        foreach ($request->choice as $item => $key) {
            $choices[] = ([
                'question_id' => $id,
                'choice' => $request->choice[$item],
                'points' => $request->points[$item],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        Choice::where('question_id','=',$id)->delete();
        Choice::insert($choices);

        $question = Question::where('id','=',$id)->first();
        

        return redirect()->route('skill.show', $question->skill_id)->with('update', 'Question updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Choice::where('question_id','=',$id)->delete();
        Question::where('id','=',$id)->delete();
        return redirect()->back()->with('delete', 'Question deleted!');
    }
}

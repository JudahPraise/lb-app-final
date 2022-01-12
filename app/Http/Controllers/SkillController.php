<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::all();
        return view('skills.index', compact('skills'));
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
        Skill::create([
            'skill_title' => $request->skill_title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Skill Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skill = Skill::where('id','=',$id)->first();
        $questions = Question::where('skill_id','=',$id)->with('choices')->get();
        return view('skills.show', compact('skill', 'questions'));
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
        Skill::where('id','=',$id)->update([
            'skill_title' => $request->skill_title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('update', 'Skill Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $question = Question::where('skill_id','=',$id)->with('choices')->delete();
        Skill::where('id','=',$id)->with('questions.choices')->delete();
        return redirect()->back()->with('delete', 'Skill Deleted!');
    }
}

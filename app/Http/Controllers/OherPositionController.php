<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Registration;
use Illuminate\Http\Request;

class OherPositionController extends Controller
{
    public function index($id, $reg_id)
    {
        $otherPositions = Position::where('id', '!=', $id)->get();
        $registration = Registration::where('id','=',$reg_id)->first();
        // dd($otherPositions);
        return view('guest-page.other-position-page', compact('otherPositions', 'registration'));
    }

    public function store(Request $request, $id, $reg_id)
    {
        $registration = Registration::where('id','=',$reg_id)->first();

        $reg = Registration::create([
            'firstname' => $registration->firstname,
            'lastname' => $registration->lastname,
            'middlename' => $registration->middlename,
            'dob' => $registration->dob,
            'gender' => $registration->gender,
            'contact_no' => $registration->contact_no,
            'email_address' => $registration->email_address, 
            'position_id' => $id
        ]);

        return redirect()->route('applicant.qualification', ['id'=>$id, 'reg_id'=>$reg->id]);
    }
}

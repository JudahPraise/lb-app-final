<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Position;

class RegistrationController extends Controller
{
    public function index()
    {
        session()->flash('cookie');
        return view('guest-page.register-page');
    }

    public function store(Request $request)
    {
        $age = \Carbon\Carbon::parse($request->dob)->diff(\Carbon\Carbon::now());

        if($age->y >= 18)
        {
           
            if($request->file)
            {
                if($request->hasFile('file')){
                    $file = $request->file;
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $request->file->storeAs('documents', $filename, 'public');
                }
    
                if($extension == 'pdf'){
                    $registration = Registration::create([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'middlename' => $request->middlename,
                        'dob' => $request->dob,
                        'gender' => $request->gender,
                        'contact_no' => $request->contact_no,
                        'email_address' => $request->email_address,
                        // 'position_id' => ''
                        'resume' => $filename,
                        'resume_permission' => $request->resume_permission == '' ? 0 : $request->resume_permission
                    ]);
    
                    return redirect()->route('register.show-positions', $registration->id)->with('success', 'Registered successfully!');
                }
    
                return redirect()->back()->with('delete', 'Required file is pdf');
            }

            return redirect()->back()->with('delete', 'Resume is required');
        }

        return redirect()->back()->with('delete', 'Cannot apply');
    }

    public function showPositions($id)
    {
        $positions = Position::with('qualifications','skills','schedule')->get();
        $registration = Registration::where('id','=',$id)->first();
        return view('guest-page.positions-page', compact('positions', 'registration'));
    }

    public function selectPosition(Request $request, $id)
    {

        $registration = Registration::where('id','=',$id)->update([
            'position_id' => $request->position_id
        ]);

        return redirect()->route('applicant.qualification', ['id' => $request->position_id, 'reg_id' => $id])->with(compact('registration'));
    }
}

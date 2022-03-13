<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class AnalyticController extends Controller
{
    //
    public function index() {
        $male = DB::table('registrations')->where('gender','=',"male")->count();
        $female = DB::table('registrations')->where('gender','=',"female")->count();

        $users = Registration::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');

        $months = Registration::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');

//dd($months->count());
$c = 0;
$m = [];
        for($i = 0; $i < $months->count(); $i++){
    
           array_push($m,$months[$c]-1);
           $c++;
        }
     
        
       
        $month = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($m as $index => $m){

            
       
            $month[$m] = $users[$index];
          
        } 

     $sex=[
         '0' => $male,
         '1' => $female,
     ];
     
    
       return view('analytic.index',compact('sex','month'));
    }
}

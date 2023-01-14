<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Working_Range;
use App\Models\Date;
use App\Models\Off_day;

use App\Models\Doctor_Specialization;

use Auth;

class ClientController extends Controller
{
    function date(Request $request)
    {
        $doctors = User::where('id' , $request['id']) -> get();
        return view('client.p_date',['doctors' => $doctors]);
    }

    function dashboard_index()
    {
        $date = Date::where('user_id',Auth::user() -> id) -> with('dates')  -> get();
        return view('client.show_date',['date' => $date] );

    }

    function choose_doctor(Request $request)
    {
        $doctors = Doctor_Specialization::where('specialization_id', $request['specialization']) -> with('range') -> get();
        return view('client.choose_doctor',['doctors' => $doctors]);
    }
    function show_choose_specialization()
    {
        return view('client.choose_specialization');
    }

    function pick_date(Request $request)
    {
        $doctors = User::where('id' , $request['id']) -> get();
        $doctor = User::where('email' , $request['email']) -> first();
        if($doctor == null)
            return view('client.p_date' , ['error' => "This doctor isn't existe in our system" ,'doctors' => $doctors]);

        $hour = date('G' , strtotime($request['date']));
        $minute = date('I' , strtotime($request['date']));
        $date = date('Y-m-d' , strtotime($request['date']));

        $off_day = Off_day::where('doctor_id' , $doctor -> id) -> where('day' , $date)->count();
        if($off_day > 0)
            return view('client.p_date' , ['error' => "This doctor has off day in the picked" ,'doctors' => $doctors]);

        $full_date = date('Y-m-d G:i:s' , strtotime($request['date']));

        $working__range = Working_Range::where('doctor_id',$doctor -> id) -> get();
        $found_time = false;
        foreach($working__range as $range)
        {
            if(($hour * 60) + $minute >= ($range -> start_hour * 60) && ($hour *60) + $minute < ($range -> end_hour *60) - ($doctor -> duration))
            {
                $found_time = true;
                break;
            }
        }

        if($found_time == false)
             return view('client.p_date', ['error' => "This doctor doesn't work in this time" ,'doctors' => $doctors]);

        $picked_dates = Date::where('doctor_id' , $doctor -> id)
                                ->where('confirmed' ,1)
                                -> where('date' , '<=' ,$full_date)
                                -> where('date' , '>' ,date('Y-m-d G:i:s' , strtotime($request['date'] . '-' . $doctor -> duration . 'minutes')))
                                ->count();

        if($picked_dates > 0)
            return view('client.p_date' , ['error' => "This time isn't available for this doctor" ,'doctors' => $doctors]);

        $picked_dates = Date::where('doctor_id' , $doctor -> id)
                            ->where('confirmed' ,1)
                            -> where('date' , '>=' ,$full_date)
                            -> where('date' , '<' ,date('Y-m-d G:i:s' , strtotime($request['date'] . '+' . $doctor -> duration . 'minutes')))
                            ->count();

        if($picked_dates > 0)
            return view('client.p_date' , ['error' => "This time isn't available for this doctor" ,'doctors' => $doctors]);

        Date::create([
            'user_id' => Auth::user() -> id,
            'doctor_id' => $doctor -> id,
            'date' => $full_date,
            'confirmed' => 1,
        ]);
        return view('client.p_date' , ['success' => "This time picked successfully" ,'doctors' => $doctors]);
    }

    function delete(Request $request)
    {
        $id =$request -> get('id');
        Date::where('id', $id) -> delete();

        $date = Date::where('user_id',Auth::user() -> id) -> get();
        return view('client.show_date',['date' => $date] );

    }
}

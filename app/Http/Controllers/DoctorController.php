<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Working_Range;
use App\Models\User;
use App\Models\Date;
use App\Models\Off_day;
use App\Models\Rating;
use Auth;

class DoctorController extends Controller
{
    function add_working_hours(Request $request)
    {

        return view('doctor/add_working_hours');
    }

    function update_time()
    {
        return view('doctor/update_user_time');
    }

    function off_days()
    {
        return view('doctor/add_off_days');
    }

    function show_dates()
    {
        $date = Date::where('doctor_id',Auth::user() -> id) -> get();
        return view('doctor/show_dates' ,['date' => $date]);
    }

    function dashboard_index()
    {
        $working__range = Working_Range::where('doctor_id',Auth::user() -> id) -> get();
        return view('/doctor/show_range',['working__range' => $working__range]);
    }

    function add_range(Request $request)
    {
        $start = $request['start'];
        $end = $request['end'];
        $working__range = Working_Range::where('doctor_id',Auth::user() -> id) -> get();
        if($start >= $end)
            return view('doctor/add_working_hours',['error' => "Please enter a valid range" , 'working__range' => $working__range]);

        foreach($working__range as $range)
        {
            if($end < $range -> start_hour || $start > $range -> end_hour)
                continue;
            return view('doctor/add_working_hours',['error' => "There is a conflict with other range" , 'working__range' => $working__range]);
        }

        Working_Range::create([
            'doctor_id' => Auth::user() -> id,
            'start_hour' => $start,
            'end_hour' => $end,
        ]);
        $working__range = Working_Range::where('doctor_id',Auth::user() -> id) -> get();
        return view('doctor/add_working_hours',['success' => "This range added successfully" , 'working__range' => $working__range]);
    }

    function update_user_time(Request $request)
    {
        $working__range = Working_Range::where('doctor_id',Auth::user() -> id) -> get();

        if($request['duration'] == "")
            return view('doctor/update_user_time',['error' => "Insert time",'working__range' => $working__range]);

        User::where('id',Auth::user() -> id) -> update([
            'duration' => $request['duration'],
        ]);
        return view('doctor/update_user_time',['success' => "This time update sucessfully",'working__range' => $working__range]);
    }

    function add_off_days(Request $request)
    {
        $date = date('Y-m-d G:i:s' , strtotime($request['date']));
        $picked_dates = Date::where('doctor_id',Auth::user() -> id)
        ->where('confirmed' ,1)
        -> where('date' , '>=' , $date)
        -> where('date' , '<' ,date('Y-m-d G:i:s' , strtotime($request['date'] . '+1 day')))
        ->count();

        if($picked_dates > 0)
            return view('doctor/add_off_days',['error' => "There are confirmed dates in thes day"]);

        $off_day = Off_day::where('day',$date)-> count();
        if($off_day > 0)
            return view('doctor/add_off_days',['error' => "The off day is previously added"]);

        Off_day::create([
            'doctor_id' => Auth::user() -> id,
            'day' => $date,
        ]);
        return view('doctor/add_off_days',['success' => "This day marked as day sucessfully"]);
    }

    function delete (Request $request)
    {
        $id =$request -> get('id');
        Working_Range::where('id', $id) -> delete();

        $working__range = Working_Range::where('doctor_id',Auth::user() -> id) -> get();
        return view('/doctor/show_range',['working__range' => $working__range]);
    }

    function add_delete(Request $request)
    {

        $date = Date::where('doctor_id',Auth::user() -> id) -> get();
        $id =$request -> get('id');
        Date::where('id', $id) -> delete();
        return view('doctor/show_dates' ,['date' => $date]);
    }

}

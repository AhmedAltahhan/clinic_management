<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Date;
use App\Models\Doctor_Specialization;
use Hash;


class AdminController extends Controller
{
    function welcome()
    {
        $admin = User::where('role', 2) -> get();
        return view('admin/welcome',['admins' => $admin]);
    }

    function show_add_specialization()
    {
        return view('admin/add_specialization');
    }

    function show_add_doctor()
    {
        return view('admin/add_doctor');
    }

    function show_doctor()
    {
        $doctors = User::where('role', 1) -> get();
        return view('admin/show_doctor',['doctors' => $doctors]);
    }

    function add_specialization(Request $request)
    {
        if(!isset($request['name']) || !isset($request['details']) || trim($request['name']) == "" || trim($request['details']) == "")
            return view('admin/add_specialization',['error' => "Insert all the fields"]);

        $name = strtolower(trim($request['name']));
        $description = trim($request['details']);
        $is_exist = Specialization::where('name',$name)-> count();

        if($is_exist > 0)
            return view('admin/add_specialization',['error' => "this specialization is already exists"]);

        Specialization::create([
            'name' => $request['name'],
            'details' => $request['details'],
        ]);
        return view('admin/add_specialization',['success' => "the  specialization added sucessfully"]) ;
    }

    function add_doctor(Request $request)
    {
        if(!isset($request['name']) || !isset($request['email']) || !isset($request['password']) || !isset($request['specialization'])
        || trim($request['name']) == "" || trim($request['email']) == "" || trim($request['password']) == "" || trim($request['specialization']) == "")
            return view('admin/add_doctor',['error' => "Insert all the fields"]);

        $name = strtolower(trim($request['name']));
        $email = trim($request['email']);
        $specialization = $request['specialization'];
        $user = User::where('name',$name)-> count();
        if($user > 0)
            return view('admin/add_doctor',['error' => "This user is already exists"]);

        $doctor = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($request['password']),
            'role' => 1,
            'duration' => 60,
        ]);

        Doctor_Specialization::create([
            'user_id' => $doctor -> id,
            'specialization_id' => $specialization,

        ]);
        return view('admin/add_doctor',['success' => "the  doctor added sucessfully"]) ;
    }

    function update(Request $request)
    {
        $id =$request -> get('id');
        $name =$request -> get('name');
        $email =$request -> get('email');
        $role =$request -> get('role');
        $duration =$request -> get('duration');

        return view('admin/update_info',['id' => $id , 'name' => $name , 'email' => $email , 'role' => $role , 'duration' => $duration]);
    }

    function update_info(Request $request)
    {
        $id =$request -> get('id');
        $name =$request -> get('name');
        $email =$request -> get('email');

        User::where('id', $id) -> update([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);
        $admin = User::where('role', 2) -> get();
        return view('admin/welcome',['admins' => $admin]);
    }

    function updatedelete(Request $request)
    {
        $id = $request -> get('id');
        $name = $request -> get('name');
        $email = $request -> get('email');
        $specializations = $request -> get('specializations');
        $id_specializations =  $request -> get('id_specializations');
        if($request -> get('update') == "Update")
        {
            return view('admin/update_doctor',['id' => $id , 'name' => $name , 'email' => $email , 'specializations' => $specializations , 'id_specializations' => $id_specializations]);
        }
        else
            User::where('id', $id) -> delete();
            Doctor_Specialization::where('user_id', $id) -> delete();
            Date::where('doctor_id', $id) -> delete();

        $doctors = User::where('role', 1) -> get();
        return view('admin/show_doctor',['doctors' => $doctors]);
    }

    function update_doctor(Request $request)
    {
        $id =$request -> get('id');
        $name =$request -> get('name');
        $email =$request -> get('email');
        $specialization = $request -> get('specialization');

        User::where('id', $id) -> update([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        Doctor_Specialization::where('user_id', $id) -> update([
            'specialization_id' => $specialization,

        ]);

        $doctors = User::where('role', 1) -> get();
        return view('admin/show_doctor',['doctors' => $doctors]);
    }

}

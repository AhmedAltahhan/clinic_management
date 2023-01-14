<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::group(['middleware' => 'guest'] , function()
{
    Route::get('/login', [UsersController::class , 'login_index'])->name('login');
    Route::post('login' , [UsersController::class , 'login']);
    Route::get('/register', [UsersController::class , 'register_index'])->name('register');
    Route::post('register' , [UsersController::class , 'register']);
});

Route::group(['middleware' => 'auth.admin'] , function()
{
    Route::get('/welcome', [AdminController::class ,'welcome'])->name('welcome');
    Route::get('/add_specialization', [AdminController::class ,'show_add_specialization'])->name('specialization');
    Route::get('/add_doctor', [AdminController::class ,'show_add_doctor'])->name('doctor');
    Route::get('/show_doctor', [AdminController::class ,'show_doctor'])->name('show');

    Route::post('/add_specialization', [AdminController::class , 'add_specialization'])->name('add_specialization');
    Route::post('/add_doctor', [AdminController::class , 'add_doctor'])->name('add_doctor');

    Route::get('update', [AdminController::class ,'update']);
    Route::post('update_info', [AdminController::class ,'update_info']);
    Route::get('updatedelete', [AdminController::class ,'updatedelete']);
    Route::post('update_doctor', [AdminController::class ,'update_doctor']);

});


Route::group(['middleware' => 'auth.doctor'] , function()
{
    Route::get('/add_range', [DoctorController::class ,'add_working_hours'])->name('add_working_hours');
    Route::get('/update_user_time', [DoctorController::class ,'update_time'])->name('update');
    Route::get('/avilable_ranges', [DoctorController::class ,'dashboard_index'])->name('avilable');
    Route::get('/off_days', [DoctorController::class ,'off_days'])->name('off_days');
    Route::get('/show_dates', [DoctorController::class ,'show_dates'])->name('show_dates');

    Route::post('/add_range', [DoctorController::class , 'add_range']);
    Route::post('/update_user_time', [DoctorController::class , 'update_user_time']);
    Route::post('/off_days', [DoctorController::class ,'add_off_days'])->name('add_off_days');
    Route::get('/remove', [DoctorController::class ,'delete'])->name('delete');
    Route::get('/add_delete', [DoctorController::class ,'add_delete'])->name('add_delete');
    Route::post('/add_rate', [DoctorController::class , 'add_rate'])->name('add_rate');
});

Route::group(['middleware' => 'auth.client'] , function()
{
    Route::get('/choose_doctor', [ClientController::class , 'choose_doctor'])->name('choose');
    Route::get('/show_specialization', [ClientController::class , 'show_choose_specialization'])->name('show_sp');

    Route::get('/pick_date', [ClientController::class , 'date'])->name('date');
    Route::get('/show_date', [ClientController::class , 'dashboard_index'])->name('home');
    Route::post('/pick_date', [ClientController::class , 'pick_date']);
    Route::get('/delete', [ClientController::class ,'delete']);
});

Route::group(['middleware' => 'auth.basic'] , function()
{
    Route::get('/logout', [UsersController::class ,'logout'])->name('logout');
});


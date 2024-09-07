<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;



Route::get('/', function () {
    return view('auth.registration');
});
// Route::get('/login', function () {
//     return view('auth.login');
// });

// Route::controller(StudentController::class)->group(function(){
//     Route::get('create-student','Create');
//     Route::post('store-student','store')->name('student.store');
//     Route::get('student-list','showinfo');
//     Route::delete('student-delete/{id}','Delete')->name('student.delete');
// });

Route::controller(AuthController::class)->group(function() {
    //Register
    Route::get('register','Resigter');
    Route::post('register-user','resigteruser')->name('register-user');
    //Login
    Route::get('login','Login');
    Route::post('login-user','loginUser')->name('login-user');
    //Dashboard
    Route::get('dashboard','Dashboard');
    //Logout
    Route::get('logout','logout');
});
    
<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')->namespace('App\Http\Controllers')->group(function(){
    Route::get('/', 'HomeController@index')->name('dashboard');

    // Calendar
    Route::get('/calendar', 'CalendarController@index')->name('calendar');
    Route::get('calendar/{date}', 'CalendarController@info')->name('calendar.info');

    // Leave form
    Route::get('/leave-form', 'LeaveFormController@index')->name('leave-form');
    Route::get('/leave-form/wait', 'LeaveFormController@waiting')->name('leave-form.wait');
    

    // Change passwor
    Route::get('/change-password', 'MemberController@changePassword')->name('change-password');
    Route::post('/change-password/confirm', 'MemberController@changePasswordConfirm')->name('change-password.confirm');
    // Work
    Route::get('/works', 'WorkController@index')->name('work.index');

    // Salary advance
    Route::get('/salary/advance', 'SalaryController@index')->name('salary.advance');

    
    Route::middleware('authen:member')->group(function(){
        // Member
        Route::get('/me', 'MemberController@me')->name('member.me');

        // Work
        Route::post('/work/diligent', 'WorkController@diligent')->name('work.diligent');

        // Leave form
        Route::get('/leave-form/create', 'LeaveFormController@create')->name('leave-form.create');
        Route::post('/leave-form/store', 'LeaveFormController@store')->name('leave-form.store');
        
        // Salary
        Route::get('/salary/create', 'SalaryController@create')->name('salary.create');
        Route::post('/salary/store', 'SalaryController@store')->name('salary.store');
    });
    Route::middleware('authen:manager')->group(function(){
        
        // Member
        Route::get('/member/index', 'MemberController@index')->name('member.index');
        Route::get('/member/create', 'MemberController@create')->name('member.create');
        Route::post('/member/store', 'MemberController@store')->name('member.store');
        Route::get('/member/profile/{id}', 'MemberController@profile')->name('member.profile');
        Route::post('/member/delete', 'MemberController@delete')->name('member.delete');
        Route::get('/member/edit/{id}', 'MemberController@editProfile')->name('member.edit');
        Route::post('/member/update/{id}', 'MemberController@updateProfile')->name('member.update');
    
        // Calendar
        Route::get('calendar/edit/{id}', 'CalendarController@edit')->name('calendar.edit');
        Route::get('calendar/{date}/create', 'CalendarController@create')->name('calendar.create');
        Route::post('calendar/{date}/store', 'CalendarController@store')->name('calendar.store');
        Route::post('calendar/update/{id}', 'CalendarController@update')->name('calendar.update');
        Route::delete('calendar/delete/{id}', 'CalendarController@delete')->name('calendar.delete');

        // Leave form
        Route::post('/leave-form/action', 'LeaveFormController@action')->name('leave-form.action');
        
        // Salary
        Route::post('/salary/action', 'SalaryController@action')->name('salary.action');
    });
});
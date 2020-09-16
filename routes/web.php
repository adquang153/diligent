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
    Route::get('/calendar', 'CalendarController@index')->name('calendar');

    // Member
    Route::get('/member/index', 'MemberController@index')->name('member.index');
    Route::get('/member/create', 'MemberController@create')->name('member.create');
    Route::post('/member/store', 'MemberController@store')->name('member.store');

    // Leave form
    Route::get('/leave-form', 'LeaveFormController@index')->name('leave-form');
    Route::get('/leave-form/create', 'LeaveFormController@create')->name('leave-form.create');
    Route::post('/leave-form/store', 'LeaveFormController@store')->name('leave-form.store');

    Route::get('/leave-form/wait', 'LeaveFormController@waiting')->name('leave-form.wait');
    Route::post('/leave-form/action', 'LeaveFormController@action')->name('leave-form.action');

    // Work
    Route::post('/meeting', 'WorkController@meeting')->name('work.meeting');
});
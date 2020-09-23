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
    Route::get('calendar/{date}/create', 'CalendarController@create')->name('calendar.create');
    Route::post('calendar/{date}/store', 'CalendarController@store')->name('calendar.store');
    Route::get('calendar/edit/{id}', 'CalendarController@edit')->name('calendar.edit');
    Route::post('calendar/update/{id}', 'CalendarController@update')->name('calendar.update');
    Route::delete('calendar/delete/{id}', 'CalendarController@delete')->name('calendar.delete');

    // Member
    Route::get('/member/index', 'MemberController@index')->name('member.index');
    Route::get('/member/create', 'MemberController@create')->name('member.create');
    Route::post('/member/store', 'MemberController@store')->name('member.store');
    Route::get('/me', 'MemberController@me')->name('member.me');

    // Leave form
    Route::get('/leave-form', 'LeaveFormController@index')->name('leave-form');
    Route::get('/leave-form/create', 'LeaveFormController@create')->name('leave-form.create');
    Route::post('/leave-form/store', 'LeaveFormController@store')->name('leave-form.store');

    Route::get('/leave-form/wait', 'LeaveFormController@waiting')->name('leave-form.wait');
    Route::post('/leave-form/action', 'LeaveFormController@action')->name('leave-form.action');

    // Work
    Route::post('/work/diligent', 'WorkController@diligent')->name('work.diligent');
    Route::get('/works', 'WorkController@index')->name('work.index');
});
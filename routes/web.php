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
    Route::get('/member/create', 'MemberController@create')->name('member.create');
    Route::post('/member/store', 'MemberController@store')->name('member.store');
});
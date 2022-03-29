<?php

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

Route::view('/', 'welcome');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::resource('motors', 'MotorController');

Route::resource('motorMembresias', 'MotorMembresiaController');

Route::resource('membresias', 'MembresiaController');

Route::resource('chatMessages', 'ChatMessageController');

Route::resource('messages', 'MessageController');

Route::resource('participantMessages', 'ParticipantMessageController');

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
//     return view('index');
// });
// Route::get('/index', function () {
//     return view('index');
// });
Route::get('/','ClinicsController@index');
Route::get('/index','ClinicsController@index');
Auth::routes();
Route::resource('clinics','ClinicsController');
Route::get('clinics/{id}/create','ClinicsController@create');
Route::delete('clinics/destroy/{id}','ClinicsController@destroy');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('home');

Route::delete('/home/{receiver_id}','HomeController@createMessage');

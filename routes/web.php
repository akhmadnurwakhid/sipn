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

Route::get('/', 'AuthController@getLogin')->middleware('guest');

Route::get('/login', 'AuthController@getLogin')->middleware('guest')->name('login');
Route::post('/login', 'AuthController@postLogin')->middleware('guest')->name('post-login');
Route::get('/logout','AuthController@logout')->middleware('auth')->name('logout');

Route::get('/home','PageController@home')->middleware('auth')->name('home');

//guru
Route::resource('guru', 'GuruController')->except(['show']);


// Kelas
Route::resource('kelas', 'KelasController')->except(['show']);


// mapel
Route::resource('mapel', 'MapelController')->except(['show']);


// tahun ajaran
Route::resource('tahun-ajaran', 'TahunAjaranController')->except(['show']);

// siswa
Route::resource('siswa', 'SiswaController')->except(['show']);

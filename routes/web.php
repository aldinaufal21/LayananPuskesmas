<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//route dashboard
Route::get('/', 'DashboardController@index')->middleware('auth');

//route poli
Route::group(['prefix'=>'poli', 'middleware'=>'auth'], function()
{
    Route::get('/', 'PoliController@index');
    Route::get('/tambah', 'PoliController@formTambah');
    Route::post('/add', 'PoliController@add');
    Route::get('/delete/{id}', 'PoliController@delete');
    Route::get('/edit/{id}', 'PoliController@formEdit');
    Route::post('/update/{id}', 'PoliController@update'); 
});

//route pasien
Route::group(['prefix'=>'pasien', 'middleware'=>'auth'], function()
{
    Route::get('/', 'PasienController@index');
    Route::get('/detail/{id}', 'PasienController@detail');
});

//route pemeriksaan
Route::group(['prefix'=>'pemeriksaan', 'middleware'=>'auth'], function()
{
    Route::get('/', 'PemeriksaanController@index');
    Route::get('/detail/{id}', 'PemeriksaanController@detail');
    Route::get('/edit/{id}', 'PemeriksaanController@formEdit');
    Route::post('/update/{id}', 'PemeriksaanController@update');
    Route::get('/batal/{id}', 'PemeriksaanController@batal');
});

//route dokter
Route::group(['prefix'=>'dokter', 'middleware'=>'auth'], function()
{
    Route::get('/', 'DokterController@index');
    Route::get('/tambah', 'DokterController@formTambah');
    Route::post('/add', 'DokterController@add');
    Route::get('/delete/{id}', 'DokterController@delete');
    Route::get('/edit/{id}', 'DokterController@formEdit');
    Route::post('/update/{id}', 'DokterController@update'); 
});

//route praktik 
Route::group(['prefix'=>'praktik', 'middleware'=>'auth'], function()
{
    Route::get('/', 'PraktikController@index');
    Route::get('/tambah', 'PraktikController@formTambah');
    Route::post('/add', 'PraktikController@add');
    Route::get('/delete/{id}', 'PraktikController@delete');
    Route::get('/edit/{id}', 'PraktikController@formEdit');
    Route::post('/update/{id}', 'PraktikController@update'); 
});

//route antrian
Route::group(['prefix'=>'antrian', 'middleware'=>'auth'], function()
{
    Route::get('/', 'AntrianController@index'); 
    Route::get('/buka', 'AntrianController@antrianBuka');
    Route::get('/tutup', 'AntrianController@antrianTutup');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


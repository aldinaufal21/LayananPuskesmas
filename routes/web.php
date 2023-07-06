<?php

use Facade\FlareClient\Report;
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
    Route::get('/edit/{id}', 'PasienController@formEdit');
    Route::get('/detail/{id}', 'PasienController@detail');
    Route::post('/update/{id}', 'PasienController@update');
});

//route pemeriksaan
Route::group(['prefix'=>'pemeriksaan', 'middleware'=>'auth'], function()
{
    Route::get('/', 'PemeriksaanController@index');
    Route::get('/detail/{id}', 'PemeriksaanController@detail');
    Route::get('/edit/{id}', 'PemeriksaanController@formEdit');
    Route::post('/update/{id}', 'PemeriksaanController@update');
    Route::get('/berat/{id}', 'PemeriksaanController@formPemeriksaanBerat');
    Route::post('/berat/update/{id}', 'PemeriksaanController@pemeriksaanBerat');
    Route::get('/kirimobat/{id}', 'PemeriksaanController@kirimobat');
    Route::get('/batal/{id}', 'PemeriksaanController@batal');
    Route::get('/selesai/{id}', 'PemeriksaanController@selesai');
    Route::get('/export', 'PemeriksaanController@export');
    Route::post('/import', 'PemeriksaanController@importExcel');
});

Route::get('/pemeriksaan_ringan', 'PemeriksaanController@viewPemeriksaanRingan')->middleware('auth');
Route::get('/pemeriksaan_berat', 'PemeriksaanController@viewPemeriksaanBerat')->middleware('auth');

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
    Route::get('/selesai/{id}', 'AntrianController@selesai');
});

//route report
Route::group(['prefix' => 'report', 'middleware' => 'auth'], function()
{
    //form report pemeriksaan
    Route::get('/pemeriksaan', 'ReportController@pemeriksaan');
    //form report dokter
    Route::get('/dokter', 'ReportController@dokter');

    //export pemeriksaan
    Route::post('/pemeriksaan/export', 'ReportController@exportPemeriksaan');
    //export dokter
    Route::post('/dokter/export', 'ReportController@exportDokter');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'authentikasi'], function()
{
    Route::get('/register', 'AuthController@registerPasien')->name('form.register');
    Route::post('/register', 'AuthController@register')->name('register.pasien');
});


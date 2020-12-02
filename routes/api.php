<?php

use App\Http\Controllers\PoliController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// view data API

//poli
//view poli
Route::get('/poli', 'PoliController@viewPoli');

//praktik
//view praktik
Route::get('/praktik', "PraktikController@viewPraktik");

//dokter
//view dokter
Route::get('/dokter', 'DokterController@viewDokter');
//view dokter by id
Route::get('/dokter/id/{id}', 'DokterController@viewDokterID');
//view dokter by poli
Route::get('/dokter/poli/{id}', 'DokterController@viewDokterPoli');

//pasien
//view pasien
Route::get('/pasien', 'PasienController@viewPasien');
//view pasien by id
Route::get('/pasien/id/{id}', 'PasienController@viewPasienID');
//add pasien
Route::post('/pasien/add', 'PasienController@addPasien');
//update pasien
Route::post('/pasien/update/{id}', 'PasienController@updatePasien');
//delete pasien
Route::get('/pasien/delete/{id}', 'PasienController@deletePasien');

//pemeriksaan
//view pemeriksaan by id pasien
Route::get('/pemeriksaan/id/{id}', 'PemeriksaanController@viewPemeriksaan');
//add pemeriksaan
Route::post('/pemeriksaan/add', 'PemeriksaanController@addPemeriksaan');
//delete pemeriksaan
Route::get('/pemeriksaan/delete/{id}', 'PemeriksaanController@deletePemeriksaan');
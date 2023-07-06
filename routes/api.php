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

//antrian
//view antrian
Route::get('/antrian/{id}', 'AntrianController@viewAntrian');

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
//update pasien
Route::post('/pasien/update/{id}', 'PasienController@updatePasien');
//delete pasien
Route::get('/pasien/delete/{id}', 'PasienController@deletePasien');
//register pasien
Route::post('/register', 'PasienController@addPasien');
//login pasien
Route::post('/login/pasien', 'PasienController@loginPasien');
//login admin
Route::post('/login', 'AuthController@loginAdmin');
//login dokter
Route::post('/login/dokter', 'AuthController@loginDokter');

//pemeriksaan
//view pemeriksaan by id pasien
Route::get('/pemeriksaan/id/{id}', 'PemeriksaanController@viewPemeriksaan');
//detail pemeriksaan
Route::get('/pemeriksaan/detail/{id}', 'PemeriksaanController@detailPemeriksaan');
//add pemeriksaan
Route::post('/pemeriksaan/add', 'PemeriksaanController@addPemeriksaan');
//delete pemeriksaan
Route::get('/pemeriksaan/delete/{id}', 'PemeriksaanController@deletePemeriksaan');
//view pemeriksaan by dokter
Route::get('/pemeriksaan/dokter/{id_dokter}', 'DokterController@viewPemeriksaan');
//view pemeriksaan by admin
Route::get('/pemeriksaan/admin', 'PemeriksaanController@viewAllPemeriksaan');
//update poli pemeriksaan
Route::post('/pemeriksaan/update/poli/{id_pemeriksaan}', 'PemeriksaanController@updatePoliPemeriksaan');

//ktp
//tambah ktp
Route::post('/ktp/tambah/{id_pasien}', 'KtpController@tambahKtp');
//update ktp
Route::post('/ktp/update/{id}', 'KtpController@updateKtp');
//delete ktp
Route::get('/ktp/delete/{id}', 'KtpController@deleteKtp');


//verification email
Route::group(['prefix' => 'email'], function()
{
    Route::get('/resend/{email}', 'VerificationEmailController@resend')->name('verification.resend');
    Route::get('/verify/{id}/{hash}', 'VerificationEmailController@verify')->name('verification.verify');
});
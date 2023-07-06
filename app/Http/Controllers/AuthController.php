<?php

namespace App\Http\Controllers;

use App\Dokter;
use App\Http\Controllers\Traits\ImageUpload;
use App\Ktp;
use App\Mail\SendMail;
use App\Pasien;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ImageUpload;

    public function registerPasien()
    {
        return view('auth.pasien.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string', 
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'gol_darah' => 'required|string',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|numeric|unique:pasien',
            'email' => 'required|string|unique:users',
            'password' => 'required|string',
            'nik' => 'required|numeric|unique:ktp',
            'foto_ktp' => 'required|file|image|mimes:jpeg,png,jpg'
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2
        ]);

        $pasien = Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin, 
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'gol_darah' => $request->gol_darah,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'id_users' => $user->id,
        ]);

        $urlFoto = $request->foto_ktp != null ?
                $this->storeImages($request->foto_ktp, 'foto_ktp') : null;

        $ktp = Ktp::create([
            'nik' => $request->nik,
            'foto' => $urlFoto,
            'id_pasien' => $pasien->id
        ]);

        $user->sendEmailVerificationNotification();

        return redirect('/login')->with('alert-success', 'Berhasil registrasi Pasien, silahkan verifikasi email terlebih dahulu!');
    }

    public function loginAdmin(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'email|string',
            'no_hp' => 'numeric',
            'access_code' => 'string',
            'password' => 'string'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'description' => 'Error !',
                'data' => $validation->errors(),
            ], 400);
        }
        else {
            if ($request->email == null && $request->access_code == null && $request->no_hp != null) {
                $get_pasien = Pasien::where('no_hp', $request->no_hp)->first();

                $get_user = User::find($get_pasien->id_users);

                if ($get_user) {
                    if (Hash::check($request->password, $get_user->password) == 1) {
                        $user = [
                            'nama' => $get_pasien->nama,
                            'alamat' => $get_pasien->alamat,
                            'berat_badan' => $get_pasien->berat_badan,
                            'tinggi_badan' => $get_pasien->tinggi_badan,
                            'gol_darah' => $get_pasien->gol_darah,
                            'tgl_lahir' => $get_pasien->tgl_lahir,
                            'no_hp' => $get_pasien->no_hp,
                            'jenis_kelamin' => $get_pasien->jenis_kelamin,
                            'email' => $get_user->email,
                            'email_verified_at' => $get_user->email_verified_at,
                            'role' => $get_user->role,
                            'created_at' => $get_user->created_at,
                            'updated_at' => $get_user->updated_at
                        ];

                        return response()->json([
                            'status' => 200,
                            'message' => 'login successfully !',
                            'data' => compact('user'),
                        ], 200);
                    }
                    else {
                        return response()->json([
                            'status' => 404,
                            'message' => 'no_hp or password wrong!',
                        ], 404);
                    }
                }
                else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'no_hp or password wrong!',
                    ], 404);
                }
            }
            elseif ($request->no_hp == null && $request->access_code == null && $request->email != null) {
                $user = User::where('email', $request->email)->first();

                if ($user) {
                    if (Hash::check($request->password, $user->password) == 1) {
                        return response()->json([
                            'status' => 200,
                            'message' => 'login successfully !',
                            'data' => compact('user'),
                        ], 200);
                    }
                    else {
                        return response()->json([
                            'status' => 404,
                            'message' => 'email or password wrong!',
                        ], 404);
                    }
                }
                else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'email or password wrong!',
                    ], 404);
                }
            } elseif ($request->email == null && $request->no_hp == null && $request->password == null && $request->access_code != null) {
                $get_user = Dokter::where('access_code', $request->access_code)->first();

                if ($get_user) {
                    $user = [
                        "id"=> $get_user->id,
                        "nama"=> $get_user->nama,
                        "ttl"=> $get_user->ttl,
                        "jenis_kelamin"=> $get_user->jenis_kelamin,
                        "alamat"=> $get_user->alamat,
                        "poli_id"=> 1,
                        "access_code"=> $get_user->access_code,
                        "created_at"=> $get_user->created_at,
                        "updated_at"=> $get_user->updated_at,
                        "role" => 3,
                    ];

                    return response()->json([
                        'status' => 200,
                        'message' => 'login successfully !',
                        'data' => compact('user'),
                    ], 200);
                }
                else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Access code wrong!',
                    ], 404);
                }
            }
        }
    }

    public function loginPasien(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'no_hp' => 'required',
            'password' => 'required', 
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'description' => 'Error !',
                'data' => $validation->errors(),
            ], 400);
        }
        else {

            if (Pasien::where('no_hp')->exists()) {
                $get_pasien = Pasien::where('no_hp')->first();

                $user = User::find($get_pasien->id_users);

                if (Hash::check($request->password, $user->password) == true) {
                    $pasien = [
                        'nama' => $get_pasien->nama,
                        'alamat' => $get_pasien->alamat,
                        'berat_badan' => $get_pasien->berat_badan,
                        'tinggi_badan' => $get_pasien->tinggi_badan,
                        'gol_darah' => $get_pasien->gol_darah,
                        'tgl_lahir' => $get_pasien->tgl_lahir,
                        'no_hp' => $get_pasien->no_hp,
                        'jenis_kelamin' => $get_pasien->jenis_kelamin,
                        'email' => $user->email,
                        'email_verified_at' => $user->email_verified_at,
                        'role' => $user->role,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at
                    ];

                    return response()->json([
                        'status' => 200,
                        'message' => 'login successfully !',
                        'data' => compact('pasien'),
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'no_hp or password wrong!',
                    ], 404);
                }
            }
            else {
                return response()->json([
                    'status' => 404,
                    'message' => 'no_hp or password wrong!',
                ], 404);
            }
        }
    }

    public function loginDokter(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'access_code' => 'required', 
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'description' => 'Error !',
                'data' => $validation->errors(),
            ], 400);
        }
        else {
            $dokter = Dokter::where('access_code', $request->access_code)->first();

            if ($dokter) {
                return response()->json([
                    'status' => 200,
                    'message' => 'login successfully !',
                    'data' => compact('dokter'),
                ], 200);
            }
            else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Akses kode tidak diketahui!'
                ], 404);
            }
        }
    }
}

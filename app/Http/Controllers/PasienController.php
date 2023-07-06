<?php

namespace App\Http\Controllers;

use App\Ktp;
use Illuminate\Http\Request;
use App\Pasien;
use App\Pemeriksaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\ImageUpload;
use App\User;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    //ambil library traits upload image
    use ImageUpload;

    //controller web

    //view pasien
    public function index()
    {
        //data pasien 
        $pasien = Pasien::join('ktp', 'ktp.id_pasien', '=', 'pasien.id')
                ->select('pasien.*', 'ktp.foto as foto_ktp', 'ktp.nik as nik')->orderBy('pasien.id', 'DESC')->get();

        return view('pasien.index', compact('pasien'));
    }

    //view detail pasien 
    public function detail($id)
    {
        //data pemeriksaan berdasarkan id pasien
        $pemeriksaan = Pemeriksaan::where('id_pasien', $id)->get();
        //data pasien berdasarkan id pasien
        $pasien = Pasien::join('ktp', 'ktp.id_pasien', '=', 'pasien.id')
                ->select('pasien.*', 'ktp.foto as foto_ktp', 'ktp.nik as nik')->where('pasien.id', $id)->first();

        //jumlah pemeriksaan berdasarkan id pasien
        $jumlah = $pemeriksaan->count();

        return view('pasien.detail', compact('pasien', 'pemeriksaan', 'jumlah'));
    }

    //view form edit
    public function formEdit($id)
    {
        //data pasien berdasarkan id pasien
        $pasien = Pasien::find($id);

        return view('pasien.edit', compact('pasien'));
    }

    //update pasien
    public function update(Request $request, $id)
    {
        //data pasien berdasarkan id pasien
        $pasien = Pasien::find($id);

        //update pasien berdasarkan request data
        $pasien->nama = $request->nama;
        $pasien->tgl_lahir = $request->tgl_lahir;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->berat_badan = $request->berat_badan;
        $pasien->tinggi_badan = $request->tinggi_badan;
        $pasien->gol_darah = $request->gol_darah;
        $pasien->no_hp = $request->no_hp;
        $pasien->alamat = $request->alamat;

        //update pasien
        $pasien->save();

        return redirect('/pasien')->with('success', 'Update pasien Berhasil!');
    }
    
    // controller pasien API

    //view pasien 
    public function viewPasien()
    { 
        //data pasien 
        $pasien = Pasien::all();
        
        return response()->json([
            "status" => 200,
            "data" => compact('pasien'),
        ], 200);
    }

    // view pasien
    public function viewPasienID($id)
    {
        //jika data pasien berdasarkan id pasien tersedia
        if(Pasien::find($id)){
            //data pasien berdasarkan id pasien
            $pasien = Pasien::with('ktp')->find($id);

            return response()->json([
                "status" => 200,
                "data" => compact('pasien'),
            ], 200);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "pasien not found"
            ], 404);
        }
    }

    // add pasien
    public function addPasien(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama' => ['required'],
            'no_hp' => ['required', 'unique:pasien', 'max:255'], 
            'alamat' => ['required', 'max:255'], 
            'jenis_kelamin' => ['required', 'numeric'], 
            'berat_badan' => ['required', 'numeric'], 
            'tinggi_badan' => ['required', 'numeric'],
            'tgl_lahir' => ['required'], 
            'email' => ['required', 'unique:users', 'email', 'string'], 
            'password' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'description' => 'Error !',
                'data' => $validation->errors(),
            ], 400);
        } 
        else {
            //add data pasien
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 2
            ]);
    
            $get_pasien = Pasien::create([
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
                "status" => 200,
                "message" => "Pasien created !",
                "data" => compact('pasien')
            ], 200);
        }
    }

    //update pasien
    public function updatePasien($id, Request $request)
    {
        //jika data pasien berdasarkan id pasien tersedia
        if(Pasien::where('id', $id)->exists()){
            //data pasien berdasarkan id pasien
            $pasien = Pasien::find($id);

            $validation = Validator::make($request->all(), [
                'nama' => ['required'],
                'no_hp' => ['required', 'max:255'], 
                'alamat' => ['required', 'max:255'], 
                'jenis_kelamin' => ['required', 'numeric'], 
                'berat_badan' => ['required', 'numeric'], 
                'tinggi_badan' => ['required', 'numeric'],
                'tgl_lahir' => ['required'], 
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'status' => 400,
                    'description' => 'Error !',
                    'data' => $validation->errors(),
                ], 400);
            }
            else {
                //update data pasien berdasarkan request data
                $pasien->nama = $request->nama;
                $pasien->alamat = $request->alamat;
                $pasien->jenis_kelamin = $request->jenis_kelamin;
                $pasien->berat_badan = $request->berat_badan;
                $pasien->tinggi_badan = $request->tinggi_badan;
                $pasien->gol_darah = $request->gol_darah;
                $pasien->tgl_lahir = $request->tgl_lahir;
                $pasien->no_hp = $request->no_hp;

                //update data pasien
                $pasien->save();

                return response()->json([
                    "status" => 200,
                    "message" => "pasien updated !"
                ], 200);
            }
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "Pasien Not Found"
            ], 404);
        }
    }

    //delete pasien
    public function deletePasien($id)
    {
        //jika data pasien berdasarkan id pasien tersedia
        if(Pasien::where('id', $id)->exists()){
            //data pasien berdasarkan id pasien
            $pasien = Pasien::find($id);
            //hapus data pasien berdasarkan id pasien
            $pasien->delete();

            return response()->json([
                "status" => 200,
                "message" => "pasien deleted !"
            ], 200);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "Pasien not found"
            ], 404);
        }
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'no_hp' => ['required'], 
            'password' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'description' => 'Error !',
                'data' => $validation->errors(),
            ], 400);
        }
        else {
            $nohp = $request->no_hp;
            $password = $request->password;

            $pasien = Pasien::where('no_hp', $nohp)->first();

            if ($pasien) {
                if (Hash::check($password, $pasien->password) == true) {
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
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'no_hp or password wrong!',
                ], 404);
            }   
        }
    }
}

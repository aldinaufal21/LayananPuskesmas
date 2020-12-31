<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;
use App\Pemeriksaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    //controller web

    //view pasien
    public function index()
    {
        //data pasien 
        $pasien = Pasien::all()->sortDesc();

        return view('pasien.index', compact('pasien'));
    }

    //view detail pasien 
    public function detail($id)
    {
        //data pemeriksaan berdasarkan id pasien
        $pemeriksaan = Pemeriksaan::where('id_pasien', $id)->get();
        //data pasien berdasarkan id pasien
        $pasien = Pasien::find($id);

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
            $pasien = Pasien::find($id);

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
        //add data pasien
        Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin, 
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'gol_darah' => $request->gol_darah,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            "status" => 201,
            "message" => "Pasien record created"
        ], 201);
    }

    //update pasien
    public function updatePasien($id, Request $request)
    {
        //jika data pasien berdasarkan id pasien tersedia
        if(Pasien::where('id', $id)->exists()){
            //data pasien berdasarkan id pasien
            $pasien = Pasien::find($id);

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
                "message" => "records Update Pasien Successfully"
            ], 200);
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
                "status" => 202,
                "message" => "records pasien deleted"
            ], 202);
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
        $nohp = $request->no_hp;
        $password = $request->password;

        $pasien = Pasien::where('no_hp', $nohp)->first();

        if ($pasien) {
            if (Hash::check($password, $pasien->password)) {
                return response()->json([
                    'status' => 200,
                    'message' => 'login successfull',
                    'data' => compact('pasien'),
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'no_hp or password wrong!',
            ], 404);
        }
    }
}
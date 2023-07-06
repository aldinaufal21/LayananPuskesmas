<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Traits\ImageUpload;
use App\Ktp;
use App\Pasien;

class KtpController extends Controller
{
    use ImageUpload;

    // API Controller

    public function tambahKtp(Request $request, $id_pasien)
    {
        //validasi data
        $validation = Validator::make($request->all(), [
            'nik' => 'required|numeric',
            'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        //jika validasi ada yang gagal
        if ($validation->fails()) {
            //tampilkan respon error validasi
            return response()->json([
                'status' => 401,
                'description' => 'error',
                'data' => $validation->errors()
            ], 200);
        } else {

            //data pasien berdasarkan id_pasien
            $pasien = Pasien::find($id_pasien);

            //jika data pasien ada
            if ($pasien) {
                $ktp = Ktp::where('id_pasien', $id_pasien)->first();

                if (empty($ktp)) {
                    //upload images
                    $foto = $request->foto;
                    $urlFoto = $foto != null ?
                        $this->storeImages($foto, 'foto_ktp') : null;

                    //create ktp
                    Ktp::create([
                        'nik' => $request->nik,
                        'foto' => $urlFoto,
                        'id_pasien' => $id_pasien,
                    ]);
                }
                else {
                    $foto = $request->foto;
                    $urlFoto = $foto != null ?
                    $this->storeImages($foto, 'foto_ktp') : $ktp->foto;

                    //update ktp
                    $ktp->nik = $request->nik;

                    $ktp->foto = $urlFoto;

                    $ktp->save();
                }

                //tampilkan respon berhasil ditambah data
                return response()->json([
                    'status' => 200, 
                    'description' => 'Ktp Created !'
                ], 200);   
            } else {
                //tampilkan respon data tidak ditemukan
                return response()->json([
                    'status' => 404, 
                    'description' => 'Ktp not found'
                ], 200);  
            }
        }
    }

    //update ktp
    public function updateKtp(Request $request, $id)
    {
        //validasi data
        $validation = Validator::make($request->all(), [
            'nik' => 'required|numeric',
            'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        //jika validasi ada yang gagal
        if ($validation->fails()) {
            //tampilkan respon error validasi
            return response()->json([
                'status' => 401,
                'description' => 'error',
                'data' => $validation->errors()
            ], 200);
        } else {
            //tampilkan data ktp berdasarkan id
            $ktp = Ktp::find($id);

            //jika data ktp ada
            if ($ktp) {
                //upload images
                $foto = $request->foto;
                $urlFoto = $foto != null ?
                $this->storeImages($foto, 'foto_ktp') : null;

                //update ktp
                $ktp->nik = $request->nik;

                $ktp->foto = $urlFoto;

                $ktp->save();

                //tampilkan respon berhasil update
                return response()->json([
                    'status' => 200,
                    'description' => 'ktp updated !'
                ], 200);
            } else {
                //tampilkan respon data tidak ditemukan
                return response()->json([
                    'status' => 404,
                    'description' => 'ktp not found !'
                ], 200);
            }
        }
    }

    public function deleteKtp($id)
    {
        //tampilkan data ktp berdasarkan id
        $ktp = Ktp::find($id);

        //jika data ktp ada
        if ($ktp) {
            //delete data ktp
            $ktp->delete();

            //tampilkan respon berhasil delete
            return response()->json([
                'status' => 200,
                'description' => 'ktp deleted !'
            ], 200);
        } else {
            //tampilkan respon data tidak ditemukan
            return response()->json([
                'status' => 404,
                'description' => 'ktp not found !'
            ], 200);
        }
    }
}

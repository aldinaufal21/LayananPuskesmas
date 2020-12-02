<?php

namespace App\Http\Controllers;

use App\Antrian;
use App\Pemeriksaan;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    //controller web

    //view pemeriksaan
    public function index()
    {
        //data pemeriksaan
        $pemeriksaan = Pemeriksaan::all()->sortDesc();

        return view('pemeriksaan.index', compact('pemeriksaan'));
    }

    //view form approve pemeriksaan
    public function formEdit($id)
    {
        //data pemeriksaan berdasarkan id pemeriksaan
        $pemeriksaan = Pemeriksaan::find($id);

        return view('pemeriksaan.edit', compact('pemeriksaan'));
    }

    //update status pemeriksaan
    public function update($id, Request $request)
    {
        //data ppemeriksaan berdasarkan id pemeriksaan
        $pemeriksaan = Pemeriksaan::find($id);
        
        //create variable tanggal hari ini
        $today = date('Y-m-d');
        //data antrian berdasarkan tanggal hari ini dan id poli
        $antrian = Antrian::whereDate('tanggal', '=', $today)->where('id_poli', $pemeriksaan->id_poli)->get();
        //jumlah data antrian berdasarkan tanggal hari ini dan id poli
        $countAntrian = $antrian->count();

        //jika status pemeriksaan yang dipilih adalah satu (status pemeriksaan ringan)
        if($request->status_pemeriksaan == '1'){
            //update data status pemeriksaan menjadi 1 (status pemeriksaan ringan)
            $pemeriksaan->status_pemeriksaan = $request->status_pemeriksaan;
            //update data status menjadi 2 (sedang ditanggapi dokter)
            $pemeriksaan->status = 2;
            //update pemeriksaan
            $pemeriksaan->save();

            return redirect('/pemeriksaan')->with('success', 'pemeriksaan berhasil di Approve!, silahkan buka PDF surat konsultasi dokter');
        }
        //jika status pemeriksaan yang dipilih adalah 2 (status pemeriksaan berat) 
        elseif($request->status_pemeriksaan == '2'){
            //jika status antrian tutup
            if ($request->session()->get('antrian') == "tutup") {
                return redirect("/pemeriksaan")->with('danger', 'antrian masih ditutup, silahkan di buka terlebih dahulu di menu dashboard!');
            } 
            //jika status antrian buka
            elseif ($request->session()->get('antrian') == "buka") {
                //update data status pemeriksaan menjadi 2 (status pemeriksaan berat)
                $pemeriksaan->status_pemeriksaan = $request->status_pemeriksaan;
                //update data status menjadi 5 (pemeriksaan offline)
                $pemeriksaan->status = 5;

                $pemeriksaan->save();
                
                //jika jumlah antrian berdasarkan tanggal hari ini dan id poli itu kurang dari atau sama dengan nol 
                if ($countAntrian <= 0) {
                    //add data antrian dimulai dari antrian pertama
                    Antrian::create([
                        "tanggal" => $today,
                        "antrian" => 1,
                        "id_pemeriksaan" => $pemeriksaan->id,
                        "id_poli" => $pemeriksaan->id_poli,
                    ]);   
                } 
                //jika jumlah antrian berdasarkan tanggal hari ini dan id poli itu lebih dari nol
                else {
                    //add data antrian berdasarkan jumlah antrian sebelumnya (jumlah antrian + 1)
                    Antrian::create([
                        "tanggal" => $today,
                        "antrian" => $countAntrian+1,
                        "id_pemeriksaan" => $pemeriksaan->id,
                        "id_poli" => $pemeriksaan->id_poli,
                    ]);  
                }

                return redirect("/pemeriksaan")->with('success', 'data telah di approve!, silahkan lihat nomor antrian!');

            }
            else{
                return redirect("/pemeriksaan")->with('danger', 'antrian masih ditutup, silahkan di buka terlebih dahulu di menu dashboard!');
            }
            
        }
    }

    //batalkan pemeriksaan
    public function batal($id)
    {
        //data pemeriksaan berdasarkan id pemeriksaan
        $pemeriksaan = Pemeriksaan::find($id);

        //update status menjadi 6 (batalkan pemeriksaan)
        $pemeriksaan->status = 6;

        //update data pemeriksaan
        $pemeriksaan->save();

        return redirect('/pemeriksaan')->with('danger','Pemeriksaaan Batal !');
    }

    //controller API

    //view pemeriksaan by id pasien
    public function viewPemeriksaan($id)
    {
        //jika data pemeriksaan berdasarkan id pasien tersedia
        if(Pemeriksaan::where('id_pasien', $id)->exists()){
            //data pemeriksaan berdasarkan id pasien
            $pemeriksaan = Pemeriksaan::where('id_pasien', $id)->get();

            return response($pemeriksaan, 200);
        }
        else{
            return response()->json([
                "error" => 404,
                "message" => "pemeriksaan not found"
            ], 404);
        }
    }

    //add data pemeriksaan
    public function addPemeriksaan(Request $request)
    {
        //add data pemeriksaan
        Pemeriksaan::create([
            "tanggal" => $request->tanggal,
            "id_poli" => $request->id_poli,
            "keluhan" => $request->keluhan,
            "id_pasien" => $request->id_pasien,
            "status_pemeriksaan" => NULL,
            "status" => 1
        ]);

        return response()->json([
            "message" => "Pemeriksaan record created"
        ], 201);
    }

    //delete pemeriksaan
    public function deletePemeriksaan($id)
    {
        //jika data pemriksaan berdasarkan id pemeriksaan tersedia
        if(Pemeriksaan::find($id)){
            //data pemeriksaan berdasarkan id pemeriksaan
            $pemeriksaan = Pemeriksaan::find($id);
            //hapus data pemeriksaan
            $pemeriksaan->delete();

            return response()->json([
                "message" => "records pemeriksaan deleted"
            ], 202);
        }
        else{
            return response()->json([
                "error" => 404,
                "message" => "Pemeriksaan not found"
            ], 404);
        }
    }
}

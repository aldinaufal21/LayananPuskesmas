<?php

namespace App\Http\Controllers;

use App\Antrian;
use App\Exports\PemeriksaanExport;
use App\Http\Controllers\Traits\ExcelUpload;
use App\Imports\PemeriksaanImport;
use App\Pemeriksaan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as MaatwebsiteExcel;
use Maatwebsite\Excel\Facades\Excel;

class PemeriksaanController extends Controller
{
    use ExcelUpload;
    //controller web

    //export pemeriksaan
    public function export()
    {
        return Excel::download(new PemeriksaanExport, 'pemeriksaan.xlsx');
    }

    //import excel
    public function importExcel(Request $request)
    {
        // validasi
		$this->validate($request, [
			'excel' => 'required|mimes:csv,xls,xlsx'
		]);

        // menangkap file excel
		$file = $request->file('excel');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('excel/pemeriksaan',$nama_file);

        Excel::import(new PemeriksaanImport, public_path('/excel/pemeriksaan/'.$nama_file));

        return redirect('/pemeriksaan')->with('success', 'berhasil import data !');
    }

    //view pemeriksaan
    public function index()
    {
        //data pemeriksaan
        $pemeriksaan = Pemeriksaan::all()->sortDesc();

        $today = date("Y-m-d");
        $cetak = NULL;
        $status = 2;
        $data = Pemeriksaan::whereDate('created_at', "=",$today)->where('cetak', $cetak)->limit(10)->get();
        $jumlah = $data->count();
        
        return view('pemeriksaan.index', compact('pemeriksaan', 'jumlah'));
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

            return redirect('/pemeriksaan')->with('success', 'pemeriksaan berhasil di Approve!, silahkan klik export pemeriksaan untuk men-download surat konsultasi dokter');
        }
        //jika status pemeriksaan yang dipilih adalah 2 (status pemeriksaan berat) 
        elseif($request->status_pemeriksaan == '2'){
            //jika status antrian tutup
            if ($request->session()->get('antrian') == "tutup") {
                return redirect("/pemeriksaan")->with('danger', 'antrian masih ditutup, silahkan di buka terlebih dahulu di menu dashboard!');
            } 
            //jika status antrian buka
            elseif ($request->session()->get('antrian') == "buka") {

                return redirect("/pemeriksaan/berat/$pemeriksaan->id");
                
                
                // //update data status pemeriksaan menjadi 2 (status pemeriksaan berat)
                // $pemeriksaan->status_pemeriksaan = $request->status_pemeriksaan;
                // //update data status menjadi 5 (pemeriksaan offline)
                // $pemeriksaan->status = 5;

                // $pemeriksaan->save();

                
                // //jika jumlah antrian berdasarkan tanggal hari ini dan id poli itu kurang dari atau sama dengan nol 
                // if ($countAntrian <= 0) {
                //     //add data antrian dimulai dari antrian pertama
                //     Antrian::create([
                //         "tanggal" => $today,
                //         "antrian" => $request->antrian,
                //         "id_pemeriksaan" => $pemeriksaan->id,
                //         "id_poli" => $pemeriksaan->id_poli,
                //         "status" => 1,
                //     ]);   
                // } 
                // //jika jumlah antrian berdasarkan tanggal hari ini dan id poli itu lebih dari nol
                // else {
                //     //add data antrian berdasarkan jumlah antrian sebelumnya (jumlah antrian + 1)
                //     Antrian::create([
                //         "tanggal" => $today,
                //         "antrian" => $countAntrian+1,
                //         "id_pemeriksaan" => $pemeriksaan->id,
                //         "id_poli" => $pemeriksaan->id_poli,
                //         "status" => 1,
                //     ]);  
                // }

                // return redirect("/pemeriksaan")->with('success', 'data telah di approve!, silahkan lihat nomor antrian!');

            }
            else{
                return redirect("/pemeriksaan")->with('danger', 'antrian masih ditutup, silahkan di buka terlebih dahulu di menu dashboard!');
            }
            
        }
    }

    public function formPemeriksaanBerat($id)
    {
        $pemeriksaan = Pemeriksaan::find($id);

        return view('pemeriksaan.pemeriksaan_berat', compact('pemeriksaan'));
    }

    public function pemeriksaanBerat($id, Request $request)
    {
        //data ppemeriksaan berdasarkan id pemeriksaan
        $pemeriksaan = Pemeriksaan::find($id);

        //create variable tanggal hari ini
        $today = date('Y-m-d');

        //update data status pemeriksaan menjadi 2 (status pemeriksaan berat)
        $pemeriksaan->status_pemeriksaan = $request->status_pemeriksaan;
        //update data status menjadi 5 (pemeriksaan offline)
        $pemeriksaan->status = 5;

        $pemeriksaan->save();

        Antrian::create([
            "tanggal" => $today,
            "antrian" => $request->antrian,
            "id_pemeriksaan" => $pemeriksaan->id,
            "id_poli" => $pemeriksaan->id_poli,
            "status" => 1,
        ]);

        return redirect("/pemeriksaan")->with('success', 'data telah di approve!, silahkan lihat nomor antrian!');
    }


    //kirim obat
    public function kirimobat($id)
    {
        //data pemeriksaan berdasarkan id Pemeriksaan
        $pemeriksaan = Pemeriksaan::find($id);

        //update status menjadi 3 (kirim obat)
        $pemeriksaan->status = 3;

        //update pemeriksaan
        $pemeriksaan->save();

        return redirect('/pemeriksaan')->with('success', 'status kirim obat berhasil !');
    }

    //kirim obat
    public function selesai($id)
    {
        //data pemeriksaan berdasarkan id Pemeriksaan
        $pemeriksaan = Pemeriksaan::find($id);

        //update status menjadi 4 (selesai)
        $pemeriksaan->status = 4;

        //update pemeriksaan
        $pemeriksaan->save();

        return redirect('/pemeriksaan')->with('success', 'pemeriksaan selesai !');
    }

    //batalkan pemeriksaan
    public function batal($id)
    {
        //data pemeriksaan berdasarkan id pemeriksaan
        $pemeriksaan = Pemeriksaan::find($id);

        //update status menjadi 6 (batalkan pemeriksaan)
        $pemeriksaan->status = 6;

        //update cetak menjadi null 
        $pemeriksaan->cetak = 1;

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

            return response()->json([
                "status" => 200,
                "data" => compact('pemeriksaan'),
            ], 200);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "pemeriksaan not found"
            ], 200);
        }
    }

    // API
    //add data pemeriksaan
    public function addPemeriksaan(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama' => ['required'],
            'no_hp' => ['required', 'unique:pasien', 'max:255'], 
            'alamat' => ['required', 'max:255'], 
            'jenis_kelamin' => ['required', 'numeric'], 
            'berat_badan' => ['required', 'numeric'], 
            'tinggi_badan' => ['required', 'numeric'],
            'tgl_lahir' => ['required'], 
            'email' => ['required', 'unique:pasien', 'email', 'string'], 
            'password' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 401,
                'description' => 'Error !',
                'data' => $validation->errors(),
            ]);
        }

        //add data pemeriksaan
        Pemeriksaan::create([
            "tanggal" => $request->tanggal,
            "id_poli" => $request->id_poli,
            "keluhan" => $request->keluhan,
            "id_pasien" => $request->id_pasien,
            "hasil_pemeriksaan" => NULL,
            "status_pemeriksaan" => NULL,
            "status" => 1,
            "cetak" => 1,
        ]);

        return response()->json([
            "status" => 200,
            "message" => "Pemeriksaan created !"
        ], 200);
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
                "status" => 200,
                "message" => "pemeriksaan deleted !"
            ], 200);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "Pemeriksaan not found"
            ], 200);
        }
    }
}

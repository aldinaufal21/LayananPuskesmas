<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poli;
use Carbon\Carbon;

class PoliController extends Controller
{
    //controller web

    //lihat poli
    public function index()
    {
        //data poli
        $poli = Poli::All()->sortDesc();

        return view('poli.index', compact('poli'));
    }

    //menampilkan form tambah
    public function formTambah()
    {
        return view('poli.tambah');
    }

    //add data poli
    public function add(Request $request)
    {
        //add data poli
        Poli::create([
            'nama_poli' => $request->nama_poli,
            'kode_antrian' => $request->kode_antrian,
        ]);

        return redirect('/poli')->with('success', 'Data berhasil ditambahkan!');
    }

    //menampilkan form edit poli
    public function formEdit($id)
    {
        //data poli berdasarkan id poli
        $poli = Poli::find($id);

        return view('poli.edit', compact('poli'));
    }

    //update data poli
    public function update(Request $request, $id)
    {
        //data poli berdasarkan id poli
        $poli = Poli::find($id);

        //update data poli berdasarkan request data
        $poli->nama_poli = $request->nama_poli;
        $poli->kode_antrian = $request->kode_antrian;

        //update data poli
        $poli->save();

        return redirect('/poli')->with('warning', 'Data berhasil diupdate!');
    }

    //delete data poli
    public function delete($id)
    {
        //data poli berdasakan id poli
        $poli = Poli::find($id);

        //delete data poli
        $poli->delete();

        return redirect('/poli')->with('danger', 'Data berhasil dihapus!');
    }

    //controller API

    //view Poli
    public function viewPoli()
    {
        //data poli
        $poli = Poli::all();

        return response($poli, 200);
    }
}

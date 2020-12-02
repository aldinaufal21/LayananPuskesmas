@extends('template.index')

@section('title')
    Edit Data Poli
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Edit Data Poli</h6>
    </div>
    <div class="card-body">
        <form action="/poli/update/{{ $poli->id }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama Poli</label>
                <input class="form-control" name="nama_poli" type="text" value="{{ $poli->nama_poli }}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Kode Antrian</label>
                <input class="form-control" name="kode_antrian" value="{{ $poli->kode_antrian }}" type="text">
            </div>
            <div class="form-group">
                <a href="/poli" class="btn btn-secondary">kembali</a>
                <input class="btn btn-warning" name="submit" type="submit" value="Edit Data">
            </div>
        </form>  
    </div>
</div>
@endsection
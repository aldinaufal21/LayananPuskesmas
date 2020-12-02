@extends('template.index')

@section('title')
    Tambah Data Poli
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Tambah Data Poli</h6>
    </div>
    <div class="card-body">
        <form action="/poli/add" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama Poli</label>
                <input class="form-control" name="nama_poli" type="text">
            </div>
            <div class="form-group">
                <a href="/poli" class="btn btn-secondary">kembali</a>
                <input class="btn btn-success" style="background-color: #148414" name="submit" type="submit" value="Tambah Data">
            </div>
        </form>  
    </div>
</div>
@endsection
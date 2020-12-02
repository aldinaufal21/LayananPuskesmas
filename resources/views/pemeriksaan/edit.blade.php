@extends('template.index')

@section('title')
    Edit Data Pemeriksaan
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Approve Data Pemeriksaan</h6>
    </div>
    <div class="card-body">
        <form action="/pemeriksaan/update/{{ $pemeriksaan->id }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Jenis Pemeriksaan</label>
                <select class="form-control" name="status_pemeriksaan" id="exampleSelect1">
                    <option value="1">Pemeriksaan Ringan</option>
                    <option value="2">Pemeriksaan Berat</option>
                </select>
            </div>
            <div class="form-group">
                <a href="/pemeriksaan" class="btn btn-secondary">kembali</a>
                <input class="btn btn-primary" name="submit" type="submit" value="Approve Data">
            </div>
        </form>  
    </div>
</div>
@endsection
@extends('template.index')

@section('title')
    Edit Data Pemeriksaan
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Input No Antrian</h6>
    </div>
    <div class="card-body">
        <form action="/pemeriksaan/berat/update/{{ $pemeriksaan->id }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">No antrian</label>
                <input type="text" name="antrian" class="form-control">
            </div>
            <div class="form-group">
                <a href="/pemeriksaan" class="btn btn-secondary">kembali</a>
                <input class="btn btn-primary" name="submit" type="submit" value="Approve Data">
            </div>
        </form>  
    </div>
</div>
@endsection
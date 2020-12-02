@extends('template.index')

@section('title')
    Edit Data Dokter
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Edit Data Dokter</h6>
    </div>
    <div class="card-body">
        <form action="/dokter/update/{{ $dokter->id }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama Lengkap</label>
                <input class="form-control" value="{{ $dokter->nama }}" name="nama" type="text">
            </div>
            <div class="form-group">
                <label for="example-date-input" class="col-form-label">Tanggal Lahir</label>
                <input class="form-control" type="date" value="{{ $dokter->ttl }}" name="ttl" id="example-date-input">
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" id="exampleSelect1">
                  <option @if ($dokter->jenis_kelamin == "Laki-Laki") selected @else  @endif value="Laki-Laki">Laki-Laki</option>
                  <option @if ($dokter->jenis_kelamin == "Perempuan") selected @else  @endif value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Alamat</label>
                <textarea class="form-control" name="alamat" id="exampleTextarea" rows="3">{{ $dokter->alamat }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Poli</label>
                <select class="form-control" name="poli_id" id="exampleSelect1">
                    @foreach ($poli as $data)
                    <option @if ($dokter->poli_id == $data->id) selected @else  @endif value="{{ $data->id }}">{{ $data->nama_poli }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <a href="/dokter" class="btn btn-secondary">kembali</a>
                <input class="btn btn-warning" name="submit" type="submit" value="Edit Data">
            </div>
        </form>  
    </div>
</div>
@endsection
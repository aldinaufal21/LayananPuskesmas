@extends('template.index')

@section('title')
    Edit Data Dokter
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Edit Data Pasien</h6>
    </div>
    <div class="card-body">
        <form action="/pasien/update/{{ $pasien->id }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama Lengkap</label>
                <input class="form-control" value="{{ $pasien->nama }}" name="nama" type="text">
            </div>
            <div class="form-group">
                <label for="example-date-input" class="col-form-label">Tanggal Lahir</label>
                <input class="form-control" type="date" value="{{ $pasien->tgl_lahir }}" name="tgl_lahir" id="example-date-input">
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" id="exampleSelect1">
                  <option @if ($pasien->jenis_kelamin == "laki-laki") selected @else  @endif value="laki-laki">Laki-Laki</option>
                  <option @if ($pasien->jenis_kelamin == "perempuan") selected @else  @endif value="perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="example-date-input" class="col-form-label">Berat Badan (*kg)</label>
                <input class="form-control" type="number" value="{{ $pasien->berat_badan }}" name="berat_badan">
            </div>
            <div class="form-group">
                <label for="example-date-input" class="col-form-label">Tinggi Badan (*cm)</label>
                <input class="form-control" type="number" value="{{ $pasien->tinggi_badan }}" name="tinggi_badan">
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Golongan Darah</label>
                <select class="form-control" name="gol_darah" id="exampleSelect1">
                  <option>Silahkan Pilih</option> 
                  <option @if ($pasien->gol_darah == "a") selected @else  @endif value="a">a</option>
                  <option @if ($pasien->gol_darah == "b") selected @else  @endif value="b">b</option>
                  <option @if ($pasien->gol_darah == "ab") selected @else  @endif value="ab">ab</option>
                  <option @if ($pasien->gol_darah == "o") selected @else  @endif value="o">o</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">No.Hp</label>
                <input class="form-control" value="{{ $pasien->no_hp }}" name="no_hp" type="text">
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Alamat</label>
                <textarea class="form-control" name="alamat" id="exampleTextarea" rows="3">{{ $pasien->alamat }}</textarea>
            </div>

            <div class="form-group">
                <a href="/pasien" class="btn btn-secondary">kembali</a>
                <input class="btn btn-warning" name="submit" type="submit" value="Edit Data">
            </div>
        </form>  
    </div>
</div>
@endsection
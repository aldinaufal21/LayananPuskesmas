@extends('template.index')

@section('title')
    Report Pemeriksaan
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Report Pemeriksaan</h6>
    </div>
    <div class="card-body">
        <form action="/report/pemeriksaan/export" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleSelect1">Poli</label>
                <select class="form-control" name="id_poli" id="exampleSelect1">
                    @foreach ($poli as $data)
                    <option value="{{ $data->id }}">{{ $data->nama_poli }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="example-date-input" class="col-form-label">Pilih Bulan</label>
                <select class="form-control" name="month" id="exampleSelect1">
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            
            <div class="form-group">
                <input class="btn btn-success" style="background-color: #148414" name="submit" type="submit" value="Export Data">
            </div>
        </form>  
    </div>
</div>
@endsection
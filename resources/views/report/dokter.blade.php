@extends('template.index')

@section('title')
    Report Dokter
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Report Data Dokter</h6>
    </div>
    <div class="card-body">
        <form action="/report/dokter/export" method="POST">
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
                <input class="btn btn-success" style="background-color: #148414" name="submit" type="submit" value="Export Data">
            </div>
        </form>  
    </div>
</div>
@endsection
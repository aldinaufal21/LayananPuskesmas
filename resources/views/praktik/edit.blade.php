@extends('template.index')

@section('title')
    Edit Data Praktik
@endsection

@section('content')

@if (session('fail'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('fail') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
    
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Edit Data Praktik</h6>
    </div>
    <div class="card-body">
        <form action="/praktik/update/{{ $praktik->id }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleSelect1">Nama Dokter</label>
                <select class="form-control" name="id_dokter" id="exampleSelect1">
                    @foreach ($dokter as $data)
                    <option @if ($praktik->id_dokter == $data->id) selected @endif value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="example-datetime-local-input" class="form-label">Mulai</label>
                <input class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($praktik->mulai)) }}" type="datetime-local" name="mulai" id="example-datetime-local-input">
            </div>
            <div class="form-group">
                <label for="example-datetime-local-input" class="form-label">Berakhir</label>
                <input class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($praktik->berakhir)) }}" type="datetime-local" name="berakhir" id="example-datetime-local-input">
            </div>


            <div class="form-group">
                <a href="/praktik" class="btn btn-secondary">kembali</a>
                <input class="btn btn-warning" name="submit" type="submit" value="Edit Data">
            </div>
        </form>  
    </div>
</div>
@endsection
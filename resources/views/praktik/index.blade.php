@extends('template.index')

@section('title')
    Kelola Praktik
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @elseif (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @elseif (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
 
    @endif  

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Data Praktik</h6>
        </div>
        <div class="card-body">
            <a href="/praktik/tambah" class="btn btn-success btn-icon-split mb-3" style="background-color: #148414">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Mulai</th>
                            <th>Berakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Mulai</th>
                            <th>Berakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($praktik as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->dokter->nama }}</td>
                                <td>{{ $data->mulai }}</td>
                                <td>{{ $data->berakhir }}</td>
                                <td>
                                    <a href="/praktik/edit/{{ $data->id }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#deletemodal" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@if (isset($data))
    @section('deletemodal')
    <a href="/praktik/delete/{{ $data->id }}" class="btn btn-danger">Hapus</a>
    @endsection
@else
    
@endif
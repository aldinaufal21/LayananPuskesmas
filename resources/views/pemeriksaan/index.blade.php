@extends('template.index')

@section('title')
    Kelola Pemeriksaan
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

    {{-- @if ($jumlah <= 0)
        
    @else
    <a href="/pemeriksaan/export" class="btn btn-primary mb-3"><i class="fa fa-print"></i> Export Pemeriksaan</a>
    @endif

    <a href="#" data-toggle="modal" data-target="#importExcel" class="btn btn-primary mb-3"><i class="fa fa-print"></i> Import Pemeriksaan</a>

    <!-- Import Excel -->
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="/pemeriksaan/import" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="excel" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Data Pemeriksaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pasien</th>
                            <th>Nama Poli</th>
                            <th>Keluhan</th>
                            <th>Kategori Pemeriksaan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pasien</th>
                            <th>Nama Poli</th>
                            <th>Keluhan</th>
                            <th>Kategori Pemeriksaan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pemeriksaan as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->pasien->nama }}</td>
                                <td>{{ $data->poli->nama_poli }}</td>
                                <td>{{ $data->keluhan }}</td>
                                <td>
                                    @if ($data->status_pemeriksaan == 1)
                                        Pemeriksaan Ringan
                                    @elseif ($data->status_pemeriksaan == 2)
                                        Pemeriksaan Berat
                                    @else
                                        belum ditentukan
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status == 1)
                                        <span class="badge badge-danger">pengajuan</span>
                                    @else 
                                    
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status == 1)
                                        <a href="/pemeriksaan/edit/{{ $data->id }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-check"></i> approve
                                        </a> 
                                    @endif
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
    <a href="/pemeriksaan/delete/{{ $data->id }}" class="btn btn-danger">Hapus</a>
    @endsection
@else
    
@endif

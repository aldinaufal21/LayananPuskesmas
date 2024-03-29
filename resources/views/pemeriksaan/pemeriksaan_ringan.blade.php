@extends('template.index')

@section('title')
    Kelola Pemeriksaan Ringan
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

    @if ($jumlah <= 0)
        
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
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Data Pemeriksaan Ringan</h6>
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
                            <th>Status</th>
                            <th>Hasil Pemeriksaan</th>
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
                            <th>Status</th>
                            <th>Hasil Pemeriksaan</th>
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
                                    @if ($data->status == 1)
                                        <span class="badge badge-danger">pengajuan</span>
                                    @elseif ($data->status == 2)
                                        <span class="badge badge-warning">sedang ditanggapi dokter</span>
                                    @elseif ($data->status == 3)
                                        <span class="badge badge-info">obat dikirim</span>
                                    @elseif ($data->status == 4)
                                        <span class="badge badge-success">selesai</span>
                                    @elseif ($data->status == 5)
                                        <span class="badge badge-light">pemeriksaan offline</span>
                                        @elseif ($data->status == 6)
                                        <span class="badge badge-danger">pemeriksaan dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $data->hasil_pemeriksaan }}
                                </td>
                                <td>
                                    @if($data->status == 2)
                                        <a href="/pemeriksaan/kirimobat/{{ $data->id }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-capsules"></i> Kirim Obat
                                        </a> 
                                        <a href="/pemeriksaan/batal/{{ $data->id }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-ban"></i> Batalkan Pemeriksaan
                                        </a>
                                    @elseif($data->status == 3)
                                        <a href="/pemeriksaan/selesai/{{ $data->id }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> selesai
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

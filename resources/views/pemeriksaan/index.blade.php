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
                                    {{-- <a href="/poli/edit/{{ $data->id }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#deletemodal" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a> --}}

                                    @if ($data->status == 1)
                                        <a href="/pemeriksaan/edit/{{ $data->id }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-check"></i> approve
                                        </a>
                                    @elseif($data->status == 2)
                                        <a href="/pemeriksaan/pdf/{{ $data->id }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-book"></i> Lihat PDF
                                        </a>
                                        <a href="/pemeriksaan/kirimobat/{{ $data->id }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-capsules"></i> Kirim Obat
                                        </a> 
                                        <a href="/pemeriksaan/batal/{{ $data->id }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-ban"></i> Batalkan Pemeriksaan
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

@extends('template.index')

@section('title')
    Kelola Poli
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

    
    <a href="/pasien" class="btn btn-primary mb-4">kembali</a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Data Pasien</h6>
        </div>
        <div class="card-body">
            <p>Nama : {{ $pasien->nama }}</p>
            <p>Alamat : {{ $pasien->alamat }}</p>
            <p>Jenis Kelamin : {{ $pasien->jenis_kelamin }}</p>
            <p>Berat Badan : {{ $pasien->berat_badan }}</p>
            <p>Tinggi Badan : {{ $pasien->tinggi_badan }}</p>
            <p>Golongan Darah : {{ $pasien->gol_darah }}</p>
            <p>Tanggal Lahir : {{ $pasien->tgl_lahir }}</p>
            <p>No HP : {{ $pasien->no_hp }}</p>
            <p>Jumlah Pemeriksaan : {{ $jumlah }}</p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Riwayat Pemeriksaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Poli</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Poli</th>
                            <th>Keluhan</th>
                            <th>Status</th>
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
                                <td>{{ $data->poli->nama_poli }}</td>
                                <td>{{ $data->keluhan }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        pengajuan
                                    @elseif ($data->status == 2)
                                        sedang ditanggapi dokter
                                    @elseif ($data->status == 3)
                                        obat dikirim
                                    @elseif ($data->status == 4)
                                        selesai
                                    @elseif ($data->status == 5)
                                        Pemeriksaan offline
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

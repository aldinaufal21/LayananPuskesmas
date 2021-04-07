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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Data Pasien</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Foto KTP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Foto KTP</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pasien as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>
                                    @if ($data->jenis_kelamin == 1)
                                        Laki-Laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                <td>{{ $data->tgl_lahir }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td><img src="{{ $data->foto }}" width="200"></td>
                                <td>
                                    <a href="/pasien/detail/{{ $data->id }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> Lihat Data
                                    </a>
                                    <a href="/pasien/edit/{{ $data->id }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit Data
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

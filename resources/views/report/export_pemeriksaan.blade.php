<h3>Rekapitulasi Pemeriksaan Puskesmas Mulya Harja</h3>
<h4>Bulan : {{ $month }}</h4> <br>

<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Pasien</th>
        <th>No Hp</th>
        <th>Poli</th>
        <th>Keluhan</th>
    </tr>
    </thead>
    <tbody>
    @php
        $no=1;
    @endphp
    @foreach($pemeriksaan as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->pasien->nama }}</td>
            <td>{{ $data->pasien->no_hp }}</td>
            <td>{{ $data->poli->nama_poli }}</td>
            <td>{{ $data->keluhan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
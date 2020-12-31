<h3>Rekapitulasi Dokter Puskesmas Mulya Harja</h3>
<br>

<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Dokter</th>
        <th>Tanggal lahir</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Poli</th>
    </tr>
    </thead>
    <tbody>
    @php
        $no=1;
    @endphp
    @foreach($dokter as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->ttl }}</td>
            <td>{{ $data->jenis_kelamin }}</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->poli->nama_poli }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
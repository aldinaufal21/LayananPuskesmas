<table>
    <thead>
    <tr>
        <th>no</th>
        <th>no_pemeriksaan</th>
        <th>tanggal</th>
        <th>nama_pasien</th>
        <th>no_hp</th>
        <th>poli</th>
        <th>keluhan</th>
        <th>hasil_pemeriksaan</th>
    </tr>
    </thead>
    <tbody>
    @php
        $no=1;
    @endphp
    @foreach($pemeriksaan as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->id }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->pasien->nama }}</td>
            <td>{{ $data->pasien->no_hp }}</td>
            <td>{{ $data->poli->nama_poli }}</td>
            <td>{{ $data->keluhan }}</td>
            <td>{{ $data->hasil_pemeriksaan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
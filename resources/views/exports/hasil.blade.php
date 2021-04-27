<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Mapel</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Score</th>
            <th>Tanggal Mengumpulkan</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($hasil as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->ujian->judul }}</td>
                <td>{{ $item->ujian->mapel->nama }}</td>
                <td>{{ $item->siswa->nama }}</td>
                <td>{{ $item->ujian->kelas->nama }} {{ $item->ujian->kelas->jurusan->alias }} {{ $item->ujian->kelas->no }}</td>
                <td>{{ $item->score }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    

    <div class="form-group">
        Judul : {{ $ujian->judul }}<br>
        Mapel : {{ $ujian->mapel->nama }}<br>
        Kelas : {{ $ujian->kelas->nama }} {{ $ujian->kelas->jurusan->alias }} {{ $ujian->kelas->no }}
    </div>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Score</th>
                <th>Dikumpulkan</th>
            </tr>
        </thead>
    
    
        <tbody>
            @foreach ($hasil as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->siswa->nama }}</td>
                    <td>{{ $item->score }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
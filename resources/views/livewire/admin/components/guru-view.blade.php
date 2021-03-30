<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Teacher</h3>
            <p class="text-subtitle text-muted">Page show for Teacher</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Teacher
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">View
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4>View Teacher - {{ $name }}</h4>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    @foreach ($dataTeacher as $item)
                        <tr>
                            <td>Name</td>
                            <td>{{ $item->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>{{ $item->nip }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ ucwords($item->jenis_kelamin) }}</td>
                        </tr>
                        <tr>
                            <td>Religion</td>
                            <td>{{ ucwords($item->agama )}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $item->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Mapels</td>
                            <td>
                                <ul style="list-style: none">
                                    @foreach ($item->mapel as $mpl)
                                        <li>{{ $mpl->nama }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>
                                <ul style="list-style: none">
                                    @foreach ($item->kelas as $kls)
                                        <li>{{ $kls->nama }} {{ $dataJurusan->alias }} {{ $kls->no }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="form-group">
                <button wire:click='editForm({{$dataId}})' class="btn btn-primary">Edit Data</button>
            </div>

        </div>
    </div>
</section>
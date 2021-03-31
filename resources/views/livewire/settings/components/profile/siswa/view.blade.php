<div id="app">
    <x-sidebar />
    <div id="main" class='layout-navbar'>
        @livewire('admin.components.navbar')
        <div id="main-content">

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Profile</h3>
                            <p class="text-subtitle text-muted">Page detail your profile</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail profile - {{ ucwords(strtolower(Auth::user()->name)) }}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $data['student']['nama'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIS</td>
                                        <td>{{ $data['student']['nis'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{ ucwords($data['student']['jenis_kelamin']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Religion</td>
                                        <td>{{ ucwords($data['student']['agama']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Class</td>
                                        <td>{{ $data['student']['kelas']['nama'] }} {{ $data['student']['jurusan']['alias'] }} {{ $data['student']['kelas']['no'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Major</td>
                                        <td>{{ $data['student']['jurusan']['nama'] }} ({{ $data['student']['jurusan']['alias'] }})</td>
                                    </tr>
                                    <tr>
                                        <td>Created At</td>
                                        <td>{{ $data['student']['created_at']->format('d M Y - H:i:s') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="form-group">
                                <button wire:click='editSiswa({{$data['student']['id']}})' class="btn btn-primary">Edit</button>
                            </div>

                        </div>
                    </div>
                </section>
            </div>

            <x-footer />
            
        </div>
    </div>
</div>
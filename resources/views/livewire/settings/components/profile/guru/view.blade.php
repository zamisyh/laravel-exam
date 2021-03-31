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
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $data['teacher']['nama'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>{{ $data['teacher']['nip'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{ ucwords($data['teacher']['jenis_kelamin']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Religion</td>
                                        <td>{{ ucwords($data['teacher']['agama']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $data['teacher']['alamat'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Mapels</td>
                                        <td>
                                            <ul style="list-style: none">
                                                @foreach ($data['teacher']['mapel'] as $mpl)
                                                    <li>{{ $mpl->nama }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class</td>
                                        <td>
                                            <ul style="list-style: none">
                                                @foreach ($data['teacher']['kelas'] as $kls)
                                                    <li>{{ $kls->nama }} {{ $kls->jurusan->alias }} {{ $kls->no }}</li>

                                                 
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="form-group">
                                <button data-toggle="modal" data-target="#updateModal" wire:click="editGuru({{ $guruId }})" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <x-footer />
        
        </div>
    </div>
</div>
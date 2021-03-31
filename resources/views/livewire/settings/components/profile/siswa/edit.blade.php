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
                            <p class="text-subtitle text-muted">Page for you edit profile</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit
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
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" wire:model.lazy='nameSiswa' class="form-control @error('nameSiswa') is-invalid @enderror ">
                                @error('nameSiswa') <span class="text-danger">{{ $message }}</span> @enderror
                            </div> 
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="number" wire:model.lazy='nisSiswa' class="form-control @error('nisSiswa') is-invalid @enderror">
                                @error('nisSiswa') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select wire:model='genderSiswa' class="form-control @error('genderSiswa') is-invalid @enderror">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('genderSiswa') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <select wire:model.lazy='religionSiswa' class="form-control @error('religionSiswa') is-invalid @enderror">
                                    <option value="islam">Islam</option>
                                    <option value="christian">Christian</option>
                                    <option value="catholic">Catholic</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="buddha">Buddha</option>
                                    <option value="konghucu">Konghucu</option>
                                    
                                </select>
                                @error('religionSiswa') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
        
                             <div class="form-group">
                                <label for="majors">Majors</label>
                                <select wire:model.lazy='majorSiswa' class="form-control @error('majorSiswa') is-invalid @enderror">
                                    <option value="" selected>Choose Majors</option>
                                    @foreach ($data['majors'] as $major)
                                        <option value="{{ $major->id }}">{{ $major->nama }}</option>
                                    @endforeach
                                </select>
                                @error('majorSiswa') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
        
                          
                            <div class="form-group">
                                <label for="class">Class</label>
                                <select wire:model='classSiswa' class="form-control @error('classSiswa') is-invalid @enderror">
                                    @foreach ($data['class'] as $class)
                                        <option value="{{ $class->id }}">{{ $class->nama }} {{ $class->jurusan->alias }} {{ $class->no }}</option>
                                    @endforeach
                                </select>
                                @error('classSiswa') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
        
                            <div class="form-group">
                                <button wire:loading.remove wire:click='updateSiswa({{$siswaId}})' class="btn btn-primary shadow-lg mt-5">Update</button>
                                <button wire:loading wire:target='updateSiswa({{$siswaId}})' type="button" disabled class="btn btn-primary shadow-lg mt-5">
                                    <span class="spinner-border" role="status"
                                    aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <x-footer />
            
        </div>
    </div>
</div>
<div>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Student</h3>
                    <p class="text-subtitle text-muted">Page show edit Student</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Student
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
                    <div class="card-title">
                        Edit Data - {{ $name }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" wire:model.lazy='name' class="form-control @error('name') is-invalid @enderror ">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> 
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" wire:model.lazy='nis' class="form-control @error('nis') is-invalid @enderror">
                        @error('nis') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select wire:model='gender' class="form-control @error('gender') is-invalid @enderror">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="religion">Religion</label>
                        <select wire:model.lazy='religion' class="form-control @error('religion') is-invalid @enderror">
                            <option value="islam">Islam</option>
                            <option value="christian">Christian</option>
                            <option value="catholic">Catholic</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                            
                        </select>
                        @error('religion') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                     <div class="form-group">
                        <label for="majors">Majors</label>
                        <select wire:model.lazy='majors' class="form-control @error('majors') is-invalid @enderror">
                            <option value="" selected>Choose Majors</option>
                            @foreach ($data['majors'] as $major)
                                <option value="{{ $major->id }}">{{ $major->nama }}</option>
                            @endforeach
                        </select>
                        @error('majors') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                  
                    <div class="form-group">
                        <label for="class">Class</label>
                        <select wire:model='class' class="form-control @error('class') is-invalid @enderror">
                            @foreach ($data['class'] as $class)
                                <option value="{{ $class->id }}">{{ $class->nama }} {{ $class->jurusan->alias }} {{ $class->no }}</option>
                            @endforeach
                        </select>
                        @error('class') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <button wire:loading.remove wire:click='updateSiswa({{$siswa_id}})' class="btn btn-primary shadow-lg mt-5">Update</button>
                        <button wire:loading wire:target='updateSiswa({{$siswa_id}})' type="button" disabled class="btn btn-primary shadow-lg mt-5">
                            <span class="spinner-border" role="status"
                            aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
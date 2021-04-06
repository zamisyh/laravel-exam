<div>
   @section('title', 'Bank Soal')
   @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-lite.min.css') }}">
        <style>
            #deleteSoal:hover{
                cursor: pointer;
                color: red;
            }

            #status:hover{
                cursor: pointer;
                ;
            }
        </style>
    @endsection

   <div id="app">
    <x-sidebar />
    <div id="main" class='layout-navbar'>
        @livewire('admin.components.navbar')
        <div id="main-content">

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>{{ $openCreateForm ? 'Create Bank Soal' : 'Bank Soal' }}</h3>
                            <p class="text-subtitle text-muted">Page for {{ $openCreateForm ? 'Create ' : 'Shows ' }} Bank Soal</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                    @if ($openCreateForm)
                                        <li class="breadcrumb-item active" aria-current="page">Create
                                        </li>
                                    @endif
                                    @if ($openCreateSoalForm)
                                        <li class="breadcrumb-item active" aria-current="page">Soal
                                        </li>
                                    @else
                                        <li class="breadcrumb-item active" aria-current="page">Bank Soal
                                        </li>
                                    @endif
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    
                        @if ($openCreateForm)
                            @include('livewire.admin.guru.create-bank-soal')
                        @elseif($openCreateSoalForm)
                            @include('livewire.admin.guru.create-soal')
                        @else
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Bank Soal</h4>
                                <button wire:click='openFormCreateClick' class="btn btn-primary">Create Bank Soal</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Mapel</th>
                                            <th>Kelas</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <th>Actions</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @forelse ($data['ujian'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->mapel->nama }}</td>
                                            <td>{{ $item->kelas->nama }} {{ $item->kelas->jurusan->alias }} {{ $item->kelas->no }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y')}}</td>
                                            <td>{{ Carbon\Carbon::parse($item->tanggal_akhir)->format('d M Y')}}</td>
                                            <td>{{ $item->ujian_setting->waktu }} Menit</td>
                                            <td>
                                                @if ($item->status == false)
                                                    <span id="status" wire:click='updateStatusDraft({{$item->id}})' class="badge bg-secondary">Draft</span class="status">
                                                @else
                                                    <span id="status" wire:click='updateStatusActive({{$item->id}}) 'class="badge bg-success">Active</span class="status">
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button wire:click='openFormSoal({{$item->id}})' class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></button>&nbsp;
                                                    <button wire:click='deleteUjian({{$item->id}})' class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                                </div>
                                            </td>

                                            @empty

                                            <td colspan="9">Ujian Kosong, silahkan buat ujian terlebih dahulu</td>

                                        </tr>
                                       @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </section>
            </div>

            <x-footer />
           
        </div>
    </div>
</div>

</div>

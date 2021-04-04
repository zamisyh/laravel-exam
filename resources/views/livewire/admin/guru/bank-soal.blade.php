<div>
   @section('title', 'Bank Soal')

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
                                    <li class="breadcrumb-item active" aria-current="page">Bank Soal
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
                                <h4 class="card-title">{{ $openCreateForm ? 'Create Bank Soal' : 'Bank Soal' }}</h4>
                                <button wire:click='openFormCreateClick' class="btn btn-primary">Create Bank Soal</button>
                            </div>
                        </div>
                    <div class="card-body">
                        @if ($openCreateForm)
                            @include('livewire.admin.guru.create-bank-soal')
                        @else
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
                                            <th>Actions</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>UH Matematika</td>
                                            <td>Matematika</td>
                                            <td>12 RPL 1</td>
                                            <td>Tanggal Mulai</td>
                                            <td>Tanggal Selesai</td>
                                            <td>Waktu</td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></button>&nbsp;
                                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                                </div>
                                            </td>  
                                        </tr>
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

<div>
    


       @section('title', 'Report')
       <div id="app">
        <x-sidebar />
        <div id="main" class='layout-navbar'>
            @livewire('admin.components.navbar')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Dashboard</h3>
                                <p class="text-subtitle text-muted">Page Dashboard for show all data ujian</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Report
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
                                    <h4 class="card-title">Data Ujian</h4>    
                                    <div>
                                        <select class="form-select" wire:model='perPage'>
                                            <option value="5" selected>5 rows</option>
                                            <option value="10">10 rows</option>
                                            <option value="15">15 rows</option>    
                                        </select>    
                                    </div>                    
                                </div>
                                <div class="col-lg-2">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text"
                                            for="inputGroupSelect01"><i class="bi bi-filter-right"></i></label>
                                        <select class="form-select" wire:model='sort' id="inputGroupSelect01">
                                            <option selected>Default</option>
                                            <option value="kelas">Kelas</option>
                                            <option value="mapel">Mapel</option>
                                        
                                        </select>
                                    </div>

                                    @if ($boxKelas)
                                        <select class="form-select" wire:model='sortKelas'>
                                            @foreach ($data['guru']['kelas'] as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['nama'] }} {{ $item['jurusan']['alias'] }} {{ $item['no'] }}</option>
                                            @endforeach         
                                        </select>
                                    @endif

                                    @if ($boxMapel)
                                        <select class="form-select" wire:model='sortMapel'>
                                            @foreach ($data['guru']['mapel'] as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                                            @endforeach         
                                        </select>
                                    @endif
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
                                                <th>Yang Mengerjakan</th>
                                                <th>Export</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['ujian'] as $key => $item)
                                                <tr>
                                                    <td>{{ $data['ujian']->firstItem() + $key }}</td>
                                                    <td>{{ $item['judul'] }}</td>
                                                    <td>{{ $item['mapel']['nama'] }}</td>
                                                    <td>{{ $item['kelas']['nama'] }}  {{ $item['kelas']['jurusan']['alias'] }} {{ $item['kelas']['no'] }}</td>
                                                    <td>
                                                        @php
                                                            $hasil = App\Models\hasil::where('ujian_id', $item->id)->get();  
                                                        @endphp

                                                        <b>{{ $hasil->count() }} Siswa</b> <br>

                                                    </td>
                                                    <td class="d-flex">
                                                        <span wire:click='export({{$item->id}})' class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-excel-fill"></i></span>&nbsp;
                                                        <span wire:click='exportPdf({{$item->id}})' class="btn btn-danger btn-sm ml-3"><i class="bi bi-file-text-fill"></i></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    {{ $data['ujian']->links() }}
                                </div>

                            </div>
                        </div>
                    
                       
                    </section>
                </div>

                <x-footer />
               
            </div>
        </div>
    </div>



    

</div>

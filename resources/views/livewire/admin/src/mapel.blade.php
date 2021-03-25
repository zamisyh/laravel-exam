<div>
    @section('title', 'Dasboard - List Mapel')

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    @endsection

    <div id="app">
        <x-sidebar />
        <div id="main" class='layout-navbar'>
            @livewire('admin.components.navbar')
            <div id="main-content">

                 @if ($openFormMapel)
                    <div class="page-heading">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3>Mapel</h3>
                                    <p class="text-subtitle text-muted">Page create Mapel</p>
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first">
                                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Mapel
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Create
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <div class="d-flex justify-content-between">
                                            Create Mapel
                                           
                                        </div>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" wire:model.lazy='name' class="form-control @error('name') is-invalid @enderror" placeholder="Eg: Matematika">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                   
                                    <div class="form-group">
                                        <button class="btn btn-primary" wire:loading.remove wire:click='createMapel'>Submit</button>
                                        <button wire:loading wire:target='createMapel' type="button" disabled class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                                            <span class="spinner-border" role="status"
                                            aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                 @else
                    <div class="page-heading">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3>Mapel</h3>
                                    <p class="text-subtitle text-muted">Page show all Mapel</p>
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first">
                                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Mapel
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <div class="d-flex justify-content-between">
                                            List Mapel
                                            <button wire:click='createForm' class="btn btn-primary">Create Mapel</button>
                                        </div>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover table-striped" id="list_mapel">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mapels as $mapel)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mapel->nama }}</td>
                                                <td>{{ $mapel->created_at }}</td>
                                                <td>
                                                    <span wire:click="deleteMapel({{$mapel->id}})" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></span>
                                                </td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                 @endif
               
                <x-footer />
               
            </div>
        </div>
    </div>

    @section('js')
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
            // Simple Datatable
            let list_mapel = document.querySelector('#list_mapel');
            let dataTable = new simpleDatatables.DataTable(list_mapel);
        </script>

    @endsection

</div>

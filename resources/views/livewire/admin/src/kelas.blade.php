<div>
    @section('title', 'Dasboard - List class')

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    @endsection

    <div id="app">
        <x-sidebar />
        <div id="main" class='layout-navbar'>
            @livewire('admin.components.navbar')
            <div id="main-content">

                 @if ($openFormClass)
                    <div class="page-heading">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3>Class</h3>
                                    <p class="text-subtitle text-muted">Page create Class</p>
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first">
                                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Class
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
                                            Create Class
                                           
                                        </div>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Class</label>
                                        <input type="number" class="form-control @error('class') is-invalid @enderror" wire:model.lazy='class'>
                                        @error('class') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="major">Major</label>
                                        <select class="form-control @error('major') is-invalid @enderror" wire:model.lazy='major'>
                                            <option value="" selected>Choose</option>
                                            @foreach ($dataJurusan as $major)
                                                <option value="{{ $major->id }}">{{ $major->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('class') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="number">Number</label>
                                        <input type="number" class="form-control @error('number') is-invalid @enderror" wire:model.lazy='number'>
                                        @error('class') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" wire:loading.remove wire:click='createClass'>Submit</button>
                                        <button wire:loading wire:target='createMajor' type="button" disabled class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
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
                                    <h3>Class</h3>
                                    <p class="text-subtitle text-muted">Page show all Class</p>
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first">
                                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Class
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
                                            List class
                                            <button wire:click='createForm' class="btn btn-primary">Create Class</button>
                                        </div>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover table-striped" id="list_class">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Class</th>
                                                <th>Major</th>
                                                <th>Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataClass as $class)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $class->nama }}</td>
                                                    <td>{{ $class->jurusan->alias }}</td>
                                                    <td>{{ $class->no }}</td>
                                                    <td>{{ $class->created_at }}</td>
                                                    <td>
                                                        <span wire:click="deleteClass({{$class->id}})" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></span>
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
            let list_class = document.querySelector('#list_class');
            let dataTable = new simpleDatatables.DataTable(list_class);
        </script>

    @endsection

</div>

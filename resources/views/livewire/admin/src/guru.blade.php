<div>
   
       @section('title', 'Dashboard - List Teacher')

       @section('css')
            <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
       @endsection

       <div id="app">
        <x-sidebar />
        <div id="main" class='layout-navbar'>
            @livewire('admin.components.navbar')
            <div id="main-content">

                <div class="page-heading">
                    @if ($viewForm)
                        
                    @include('livewire.admin.components.guru-view')
                    
                    @elseif($editForm)

                    @include('livewire.admin.components.guru')

                    @else
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Teacher</h3>
                                <p class="text-subtitle text-muted">Page show for all Teacher</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Teacher
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
                                    <h4>List Teacher</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-striped" id="list_teacher">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>NIP</th>
                                            <th>Gender</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['guru'] as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ ucwords(strtolower($item->jenis_kelamin)) }}</td>
                                                <td>{{  $item->created_at->format('d M Y - H:i:s') }}</td>
                                                <td class="d-flex">
                                                   
                                                    <button wire:click='viewForm({{$item->id}})' class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>&nbsp;
                                                    <button wire:click='deleteForm({{$item->id}})' class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    @endif
                </div>

                
                <x-footer />


               
            </div>

            
        </div>
    </div>


    @section('js')
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
            // Simple Datatable
            let list_teacher = document.querySelector('#list_teacher');
            let dataTable = new simpleDatatables.DataTable(list_teacher);
        </script>

        <script src="{{ asset('assets/vendors/select2/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>

    @endsection

    
</div>

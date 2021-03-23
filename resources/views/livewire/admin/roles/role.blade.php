<div>
    @section('title', 'Dashboard User Roles')

    <div id="app">
        <x-sidebar />
        <div id="main" class='layout-navbar'>
             @livewire('admin.components.navbar')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Roles</h3>
                                <p class="text-subtitle text-muted">Page for setting roles users</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Role
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                       
                        <div class="row">
                            <div class="col-lg-4">
                               <div class="card">
                                    <div class="card-header"><h4>Create new Role</h4></div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" wire:model.lazy='role' class="form-control @error('role') is-invalid @enderror" placeholder="Add new role">
                                            @error('role') <span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <button wire:loading.remove wire:click='createRole' class="btn btn-primary btn-block">Add</button>
                                            <button wire:loading wire:target='createRole' class="btn btn-primary btn-block" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header"><h4>List Role</h4></div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-based table-hover table-responsive">
                                            <thead class="bg-success text-white ">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Role</th>
                                                    <th>Guard</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($listRole as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->guard_name }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>
                                                            <button wire:click.prevent='deleteRole({{$item->id}})' class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                                            
                                                        </td>
                                                    
                                                @empty
                                                        <td>No Role</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
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

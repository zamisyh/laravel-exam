<div>
    @section('title', 'Dasboard - List Users')

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    @endsection

    <div id="app">
        <x-sidebar />
        <div id="main" class='layout-navbar'>
            @livewire('admin.components.navbar')
            <div id="main-content">

                @if ($openCreateForm)
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Users</h3>
                                <p class="text-subtitle text-muted">Page for {{ $editForm ? 'edit' : 'create' }} User</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Users
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
                                <h4 class="card-title">Form {{ $editForm ? 'edit' : 'create' }} User</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" wire:model.lazy='name' class="form-control @error('name') is-invalid @enderror" placeholder="Input your name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" wire:model.lazy='email' class="form-control @error('email') is-invalid @enderror" placeholder="Input your email">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control @error('role') is-invalid @enderror" wire:model.lazy='role'>
                                        <option value="" selected>Choose</option>

                                        @foreach ($userRole as $role)
                                            <option value="{{ $role->name }}">{{ ucwords(strtolower( $role->name)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if (!$editForm)
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" wire:model.lazy='password' class="form-control @error('password') is-invalid @enderror" placeholder="Input your password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" wire:model.lazy='confirm_password' class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Input your Confirm Password">
                                    </div>
                                @endif
                                <div class="form-group">
                                    @if ($editForm)
                                        <button class="btn btn-primary" wire:loading.remove wire:click='updateUser({{$editId}})'>Update</button>
                                        <button wire:loading wire:target='updateUser' class="btn btn-primary" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                        </button>
                                    @else
                                        <button class="btn btn-primary" wire:loading.remove wire:click='createUser'>Submit</button>
                                        <button wire:loading wire:target='createUser' class="btn btn-primary" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                        </button>
                                    @endif
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
                                <h3>Users</h3>
                                <p class="text-subtitle text-muted">Page show all users</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Users
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
                                        List Users
                                        <button wire:click='createForm' class="btn btn-primary">Create User</button>
                                    </div>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-striped" id="list_user">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data['users'] as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @foreach ($user->getRoleNames() as $role)
                                                        {{ ucwords(strtolower($role)) }}
                                                    @endforeach
                                                </td>
                                                <td>

                                                    @if ($user->is_active == 0)
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @else
                                                            <span class="badge bg-success">Active</span>
                                                    @endif

                                                </td>
                                                <td class="d-flex">
                                                    <button wire:click='edit({{ $user->id }})' class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                                                    <button wire:click='delete({{$user->id}})' class="btn btn-danger btn-sm" style="margin-left: 3px"><i class="bi bi-trash-fill"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                            
                                        @endforelse
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
            let list_user = document.querySelector('#list_user');
            let dataTable = new simpleDatatables.DataTable(list_user);
        </script>

    @endsection

</div>

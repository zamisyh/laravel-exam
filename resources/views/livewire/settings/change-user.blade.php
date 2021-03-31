<div id="app">

    @section('title', 'Profile User Setting')

    <x-sidebar />
    <div id="main" class='layout-navbar'>
        @livewire('admin.components.navbar')
        <div id="main-content">

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Settings</h3>
                            <p class="text-subtitle text-muted">Page Edit your profile user Setting</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Setting
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Profile User - {{ ucwords(strtolower(Auth::user()->name)) }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input wire:model.lazy='name' type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Input your new name">
                                @error('name') <span class="text-danger"> {{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input wire:model.lazy='email' type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Input your new email">
                                @error('email') <span class="text-danger"> {{ $message }}</span> @enderror
                            </div>

                            @if ($changePass)
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input wire:model.lazy='password' type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Input your new password">
                                    @error('password') <span class="text-danger"> {{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirmation Password</label>
                                    <input wire:model.lazy='confirm_password' type="password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Input your new password">
                                    @error('confirm_password') <span class="text-danger"> {{ $message }}</span> @enderror
                                </div>

                                <a href="#" wire:click='closePassword'>Click if no a password</a>
                            @else
                                <a href="#" wire:click='changePassword'>Click if with a password</a>
                            @endif

                            <div class="form-group mt-3">
                                <button wire:loading.remove wire:click='updateUser({{$uid}})' class="btn btn-primary">Update</button>
                                <button wire:loading wire:target='updateUser({{$uid}})' type="button" disabled class="btn btn-primary">
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



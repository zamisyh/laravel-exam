<div>
    @section('title', 'Signup Page')

    <div id="auth">

        <div class="d-flex justify-content-center">
            <div class="col-lg-6 col-12 m-auto">
                <div id="auth-left">
                    {{-- <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div> --}}



                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">Input your data to register to our website.</p>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" wire:model='email' class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" wire:model='username' class="form-control form-control-xl @error('username') is-invalid @enderror" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" wire:model='password' class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        @error('confirm_password') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" wire:model='confirm_password' class="form-control form-control-xl @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                    @if ($redirect)
                        <script>
                            setTimeout(function () {
                                window.location.href = "{{ route('client.signin') }}";
                            }, 2000);
                        </script>

                        <button type="button" disabled class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            <span class="spinner-border" role="status"
                            aria-hidden="true"></span>
                        </button>

                        @else

                        <button wire:loading.remove wire:click.prevent='signup' class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                        <button wire:loading wire:target='signup' type="button" disabled class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            <span class="spinner-border" role="status"
                            aria-hidden="true"></span>
                        </button>
                    @endif

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="{{ route('client.signin') }}"
                                class="font-bold">Log
                                in</a>.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

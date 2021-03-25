<div>
    @section('title', 'Signin Page')

    @if (Auth::check())
        <script>
           window.location.href = "{{ route('dashboard.home') }}";
        </script>
    @endif

    <div id="auth">

        <div class="d-flex justify-content-center">
            <div class="col-lg-6 col-12 m-auto">
                <div id="auth-left">
                    {{-- <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div> --}}

                   

                    <h1 class="auth-title">Sign In</h1>
                    <p class="auth-subtitle mb-5">Enter your data before using this application</p>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" wire:model='email' class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" wire:model='password' class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" id="flexCheckDefault" required>
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                               Keep me sign in
                            </label>
                        </div>

                    @if ($redirect)
                        <script>
                            setTimeout(function () {
                                window.location.href = "{{ route('dashboard.home') }}";
                            }, 3000);
                        </script>

                        <button type="button" disabled class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            <span class="spinner-border" role="status"
                            aria-hidden="true"></span>
                        </button>

                        @else

                        <button wire:loading.remove wire:click.prevent='signin' class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign In</button>
                        <button wire:loading wire:target='signin' type="button" disabled class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            <span class="spinner-border" role="status"
                            aria-hidden="true"></span>
                        </button>
                    @endif

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Don't have an account? <a href="{{ route('client.signup') }}"
                                class="font-bold">Sign
                                Up</a>.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

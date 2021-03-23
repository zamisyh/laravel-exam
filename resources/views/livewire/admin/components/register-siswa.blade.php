<div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    @endsection

    <div id="auth">

        <div class="d-flex justify-content-center">
            <div class="col-lg-6 col-12 m-auto">
                <div id="auth-left">
                    {{-- <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div> --}}

                   

                    <h1 class="auth-title">Hallo, {{ ucwords(strtolower(Auth::user()->name)) }}</h1>
                    <p class="auth-subtitle mb-5">Register Step 2. Before using this application, you must complete your data</p>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" wire:model='email' class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                      

                    {{-- @if ($redirect)
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
                    @endif --}}

                    
                </div>
            </div>

        </div>

    </div>
</div>

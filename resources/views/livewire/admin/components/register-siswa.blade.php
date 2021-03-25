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
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative mb-4">
                            <input type="text" wire:model='name' class="form-control form-control-xl @error('name') is-invalid @enderror" placeholder="Input your name">
                          
                        </div>

                        @error('nis') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative mb-4">
                            <input type="number" wire:model='nis' class="form-control form-control-xl @error('nis') is-invalid @enderror" placeholder="Input your nis">
                           
                        </div>

                        @error('majors') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative mb-4">
                            <select wire:model='majors' class="form-control form-control-xl  @error('majors') is-invalid @enderror">
                                <option value="" selected>Choose Majors</option>
                                @foreach ($data['majors'] as $major)
                                    <option value="{{ $major->id }}">{{ $major->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('class') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative mb-4">
                            <select wire:model='class' class="form-control form-control-xl  @error('class') is-invalid @enderror">
                                <option value="" selected>Choose Class</option>
                                @foreach ($data['class'] as $class)
                                    <option value="{{ $class->id }}">{{ $class->nama }} {{ $class->jurusan->alias }} {{ $class->no }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative mb-4">
                            <select wire:model='gender' class="form-control form-control-xl  @error('gender') is-invalid @enderror">
                                <option value="" selected>Choose Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        @error('religion') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="form-group position-relative mb-4">
                            <select wire:model='religion' class="form-control form-control-xl  @error('religion') is-invalid @enderror">
                                <option value="" selected>Choose Religion</option>
                                <option value="islam">Islam</option>
                                <option value="christian">Christian</option>
                                <option value="catholic">Catholic</option>
                                <option value="hindu">Hindu</option>
                                <option value="buddha">Buddha</option>
                                <option value="konghucu">Konghucu</option>
                                

                            </select>
                        </div>

                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" id="flexCheckDefault" required>
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                               I agree to the terms and conditions
                            </label>
                        </div>

                        <div class="form-group">
                           

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
                            <button wire:loading.remove wire:click.prevent='createSiswa' class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Submit</button>
                            <button wire:loading wire:target='createSiswa' type="button" disabled class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                                <span class="spinner-border" role="status"
                                aria-hidden="true"></span>
                            </button>
                            
                        @endif

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

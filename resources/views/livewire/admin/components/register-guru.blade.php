<div>
    <div>

        @section('css')
            <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
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

                            @error('nip') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="form-group position-relative mb-4">
                                <input type="number" wire:model='nip' class="form-control form-control-xl @error('nip') is-invalid @enderror" placeholder="Input your nip">
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

                            <div class="form-group position-relative mb-4">
                                <textarea class="form-control" wire:model='address' rows="3" placeholder="Input your address"
                                    id="floatingTextarea"></textarea>
                               
                            </div>
                            
                            <div class="form-group position-relative mb-4" wire:ignore>
                                <span class="mapel">Mapel</span>
                                <select wire:model='mapel' id="select2" class="form-select"
                                    multiple="multiple">
                                
                                    @foreach ($data['mapels'] as $mapel)
                                        <option value="{{ $mapel->id }}" selected>{{ $mapel->nama }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group position-relative mb-4" wire:ignore>
                                <span class="class">Class</span>
                                <select wire:model='class' id="select2_class" class="form-select"
                                    multiple="multiple">
                                
                                    @foreach ($data['class'] as $class)
                                        <option value="{{ $class->id }}" selected>{{ $class->nama }} {{ $class->jurusan->alias }} {{ $class->no }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                           

                            <div class="form-check form-check-lg d-flex align-items-end">
                                <input class="form-check-input me-2" wire:model='checkbox' type="checkbox" id="flexCheckDefault" required>
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
                                <button wire:loading.remove wire:click.prevent='createGuru' class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Submit</button>
                                <button wire:loading wire:target='createGuru' type="button" disabled class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                                    <span class="spinner-border" role="status"
                                    aria-hidden="true"></span>
                                </button>
                                
                            @endif
    
                            </div>

                        
                    </div>
                </div>
    
            </div>
    
        </div>
    </div>

    @section('js')  
        <script src="{{ asset('assets/vendors/select2/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
      
        
      

        <script>
            $(document).ready(function() {
                $('#select2').select2({
                    theme: "classic"
                });
        
                $('#select2').on('change', function() {
                    @this.mapel = $(this).val();
                })

                $('#select2_class').select2({
                    theme: "classic"
                });
        
                $('#select2_class').on('change', function() {
                    @this.class = $(this).val();
                })
            });
        </script>
        @endsection
    
    
</div>

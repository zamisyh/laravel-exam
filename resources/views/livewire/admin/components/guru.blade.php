<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Teacher</h3>
            <p class="text-subtitle text-muted">Page show for update Teacher</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Teacher
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit
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
                <h4>Update Teacher - {{ $name }}</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model='name'>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="number" class="form-control @error('nip') is-invalid @enderror" wire:model='nip'>
                @error('nip') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control @error('gender') is-invalid @enderror" wire:model='gender'>
                    <option value="{{ $gender }}">{{ ucwords($gender) }}</option>
                    <option disabled>-----------------</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="agama">Religion</label>
                <select class="form-control @error('religion') is-invalid @enderror" wire:model='religion'>
                    <option value="{{ $religion }}">{{ ucwords($religion) }}</option>
                    <option disabled>-----------------</option>
                    <option value="islam">Islam</option>
                    <option value="christian">Christian</option>
                    <option value="catholic">Catholic</option>
                    <option value="hindu">Hindu</option>
                    <option value="buddha">Buddha</option>
                    <option value="konghucu">Konghucu</option>
                </select>
                @error('religion') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-control">
                <label for="address">Address</label>
                <textarea rows="5" wire:model='address' class="form-control @error('address') is-invalid @enderror">{{ $address }}</textarea>
                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group position-relative mb-4" wire:ignore>
                <span class="mapel">Mapel</span>

                
                
         
                <select wire:model='mapel' id="select2" class="form-select @error('mapel') is-invalid @enderror"
                    multiple="multiple" required>
                    
                
                    @foreach ($data['mapels'] as $mapel)
                        <option value="{{ $mapel->id }}">
                            {{ $mapel->nama }}
                        </option>
                    @endforeach
                    
                </select>
                @error('mapel') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group position-relative mb-4" wire:ignore>
                <span class="class">Class</span>
                <select wire:model='class' id="select2_class" class="form-select @error('class') is-invalid @enderror"
                    multiple="multiple" required>

                    
                
                    @foreach ($data['class'] as $class)
                        <option value="{{ $class->id }}" selected>{{ $class->nama }} {{ $class->jurusan->alias }} {{ $class->no }}</option>
                    @endforeach

                    
                    
                </select>
                @error('class') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <button wire:loading.remove wire:click='update({{$guruId}})' class="btn btn-primary">Update</button>
                <span wire:loading wire:target='update({{$guruId}})'>Updating..</span>
            </div>

            {{-- <select name="" id="">
                @foreach ($dataMapelId as $item)
                    <option value="{{ $item->mapel_id }}">{{ $item->nama }}</option>
                @endforeach
            </select> --}}
            
        </div>
    </div>
</section>

<script>


    $(document).ready(function() {

      
        $('#select2').select2({
            theme: "classic",
            placeholder: 'Select Mapel'
        });
    
    
        $('#select2').on('change', function() {
            @this.mapel = $(this).val();
        })

        $('#select2_class').select2({
            theme: "classic",
            placeholder: 'Select Class'
            
        });

        $('#select2_class').on('change', function() {
            @this.class = $(this).val();
        })
    });
</script>


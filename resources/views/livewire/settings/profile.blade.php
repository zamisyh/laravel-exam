<div>
    
    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    @endsection

    @if ($pageSiswa)
        @section('title', 'Profile Student')

        @if ($editPageSiswa)
            @section('title', 'Edit Profile Student')
            @include('livewire.settings.components.profile.siswa.edit')
        @else
            @section('title', 'Profile Student')
            @include('livewire.settings.components.profile.siswa.view')
        @endif

    

    @elseif ($pageGuru)
        @if ($editPageGuru)
            @section('title', 'Edit Profile Teacher')
            @include('livewire.settings.components.profile.guru.edit')
        @else
            @section('title', 'Profile Teacher')
            @include('livewire.settings.components.profile.guru.view')
        @endif
    
    @endif

</div>

@section('js')
<script src="{{ asset('assets/vendors/select2/jquery.js') }}"></script>
<script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
@endsection


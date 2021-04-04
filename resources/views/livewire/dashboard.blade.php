<div>
    
    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    @endsection

    @if ($openRegisterSiswa)
            @section('title', 'Siswa Next Register')
            @livewire('admin.components.register-siswa') 
       @elseif($openRegisterGuru)
            @section('title', 'Guru Next Register')
            @livewire('admin.components.register-guru')
       @else

       @section('title', 'Dashboard')
       <div id="app">
        <x-sidebar />
        <div id="main" class='layout-navbar'>
            @livewire('admin.components.navbar')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Dashboard</h3>
                                <p class="text-subtitle text-muted">Page Dashboard for show all features</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Home
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">

                       @role('guru')
                            @include('livewire.admin.components.guru.info')
                            @include('livewire.admin.components.guru.recent-soal')                         
                       @endrole
                        
                    
                       
                    </section>
                </div>

                <x-footer />
               
            </div>
        </div>
    </div>

    @endif

    

</div>

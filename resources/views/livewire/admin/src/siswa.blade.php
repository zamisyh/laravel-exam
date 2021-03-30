<div>
    @section('title', 'Dasboard - List Student')

    <div id="app">
        <x-sidebar />
        <div id="main" class='layout-navbar'>
            @livewire('admin.components.navbar')
            <div id="main-content">
                
                @if ($openEdit)
                    
                    @include('livewire.admin.components.siswa-edit')

                @else 

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Student</h3>
                                <p class="text-subtitle text-muted">Page show all Students</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Student
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
                                       <div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text"
                                                    for="inputGroupSelect01"><i class="bi bi-filter"></i></label>
                                                <select class="form-select" wire:model='search' id="inputGroupSelect01">
                                                    <option value="default">Default</option>
                                                    <option value="class">Class</option>
                                                    <option value="name">Name</option>
                                                    <option value="nis">Nis</option>
                                                </select>
                                            </div>

                                           
                                            

                                            @if ($search == 'class')
                                                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search class" >
                                            
                                            @elseif($search == 'default')
                                                <span></span>
                                           
                                            @elseif($search)
                                                <input type="text" wire:model='searchData' class="form-control" placeholder="Search {{ $search }}">
                                            
                        
                                            @endif
                                           
                                       </div>

                                       <div>
                                           <select class="form-select" wire:model='row_page'>
                                               <option value="10" selected>10 row</option>
                                               <option value="25">25 row</option>
                                               <option value="50">50 row</option>
                                               <option value="80">80 row</option>
                                           </select>
                                       </div>
                                    </div>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="list_majors">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>NIS</th>
                                                <th>Gender</th>
                                                <th>Class</th>
                                                <th>Religion</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($student as $item)
                                               <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucwords(strtolower($item->nama)) }}</td>
                                                    <td>{{ $item->nis }}</td>
                                                    <td>
                                                        @if ($item->jenis_kelamin == 'male')
                                                            <span class="badge bg-light-success">  {{ ucwords(strtolower($item->jenis_kelamin)) }}</span>
                                                        @else
                                                            <span class="badge bg-light-danger">  {{ ucwords(strtolower($item->jenis_kelamin)) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->kelas->nama }} {{ $item->jurusan->alias }} {{ $item->kelas->no }}</td>
                                                    <td>{{ ucwords($item->agama) }}</td>
                                                    <td class="d-flex">
                                                        <button wire:click='deleteSiswa({{$item->id}})' class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>&nbsp;
                                                        <button wire:click='editSiswa({{$item->id}})' class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                                                    </td>
                                                    
                                                    @empty
                                                    <td>No Data Found</td>

                                               </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    {{ $student->links() }}
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                @endif
               
                <x-footer />
               
            </div>

            @section('js')
            <script>
                function myFunction() {
                  var input, filter, table, tr, td, i, txtValue;
                  input = document.getElementById("myInput");
                  filter = input.value.toUpperCase();
                  table = document.getElementById("list_majors");
                  tr = table.getElementsByTagName("tr");
                  for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[4];
                    if (td) {
                      txtValue = td.textContent || td.innerText;
                      if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                      } else {
                        tr[i].style.display = "none";
                        
                      }
                    }       
                  }
                }
                </script>
            @endsection

        </div>
    </div>

</div>

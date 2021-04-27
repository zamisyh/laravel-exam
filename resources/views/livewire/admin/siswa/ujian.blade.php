<div>
    
  

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
                                <p class="text-subtitle text-muted">Page Dashboard for Exams</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Exams
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
                                    <h4 class="card-title">{{ $this->ujian->judul }}</h4>
                                    @if ($openUjianForm)
                                        <div class="time">
                                            <b>Time <span id="timer" style="color: red">0.00</span></b><br>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if ($refresh)
                                <meta http-equiv="refresh" content="1">
                            @endif

                            @if ($openUjianForm)
                                <div class="card-body" wire:ignore>

                                    
                                    @foreach ($soals as $key => $item)
                                        <div class="form-group">
                                            <div class="uraian">
                                                 {{ $loop->iteration }} . 

                                                
                                                @if ($item->image != null)
                                                    <img class="img-fluid rounded mx-auto d-block" src="{{asset('storage/images/soal/' . $item->image)}}"/>
                                                @endif
                                                

                                                 <span>{{ $item->uraian }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <ul style="list-style: none; margin-top:10px;">
                                                <li><input type="radio" wire:model.lazy='answer.{{ $item->id }}' value='a' name="answer.{{ $item->id }}"> <span style="margin-left:10px;">A. {{ $item->opsi_a }}</span></li> 
                                                <li><input type="radio" wire:model.lazy='answer.{{ $item->id }}' value='b' name="answer.{{ $item->id }}"> <span style="margin-left:10px;">B. {{ $item->opsi_b }}</span></li> 
                                                <li><input type="radio" wire:model.lazy='answer.{{ $item->id }}' value='c' name="answer.{{ $item->id }}"> <span style="margin-left:10px;">C. {{ $item->opsi_c }}</span></li> 
                                                <li><input type="radio" wire:model.lazy='answer.{{ $item->id }}' value='d' name="answer.{{ $item->id }}"> <span style="margin-left:10px;">D. {{ $item->opsi_d }}</span></li> 
                                                <li><input type="radio" wire:model.lazy='answer.{{ $item->id }}' value='e' name="answer.{{ $item->id }}"> <span style="margin-left:10px;">E. {{ $item->opsi_e }}</span></li> 
                                                @error('answer') <span class="text-danger">{{ $message }}</span>@enderror
                                                
                                            </ul>
                                        </div>
                                    @endforeach

                                    <div class="form-group mt-5">
                                        <button wire:click='saveSoal({{$this->ujian->id}})' id="submitted" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                                
                            @else

                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Time</td>
                                                        <td>{{ $this->ujian->ujian_setting->waktu }} Menit</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mapel</td>
                                                        <td>{{ $this->ujian->mapel->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Guru</td>
                                                        <td>{{ $this->ujian->guru->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kelas</td>
                                                        <td>{{ $this->ujian->kelas->nama }} {{ $this->ujian->kelas->jurusan->alias }} {{ $this->ujian->kelas->no }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Ujian</td>
                                                        <td>{{ Carbon\carbon::parse($this->ujian->tanggal_mulai)->format('d M Y') }} - 
                                                            {{ Carbon\carbon::parse($this->ujian->tanggal_akhir)->format('d M Y') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status</td>
                                                        <td>
                                                           @if (!empty($this->hasilSiswa))
                                                                @if ($this->hasilSiswa->status == true)
                                                                    <span class="badge bg-success">Sudah Mengerjakan</span>
                                                                @endif
                                                           @else
                                                                <span class="badge bg-warning">Belum Mengerjakan</span>
                                                           @endif
                                                        </td>
                                                    </tr>

                                                    @if (!empty($this->hasilSiswa))
                                                        <tr>
                                                            <td>Score</td>
                                                            <td>
                                                                @if ($this->hasilSiswa->ujian->ujian_setting->tampil_nilai == true)
                                                                    <span class="badge bg-primary">{{ $this->hasilSiswa->score }}/{{ $this->hasilSiswa->ujian->ujian_setting->jumlah_soal }}</span>
                                                                
                                                                @else
                                                                    Untuk sementara nilai anda kami rahasiakan
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> 

                                    @if (!empty($this->hasilSiswa))
                                       @if ($this->hasilSiswa->status == true)
                                            Selamat, anda sudah mengerjakan <b>{{ $this->hasilSiswa->ujian->judul }}</b>
                                       @endif

                                    @else
                                      @if ($getDate != null)
                                        <div class="form-group">
                                            <label for="token">Token</label>
                                            <input type="text" wire:model='token' class="form-control {{ $tokenError ? 'is-invalid' : '' }} " placeholder="Masukkan token">
                                        </div>

                                        @if ($tokenError)
                                            <div class="form-group">
                                                <span class="text-danger">Token Tidak Valid</span>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <button class="btn btn-success" wire:click='ujianNow'>Submit</button>
                                        </div>

                                        @else

                                            Mohon maaf ujian telah berakhir atau belum dimulai
                                 
                                      @endif
                                    @endif
                                  
    
                                </div>
                            @endif

                    
                         
                        </div>
                     
                    
                    </section>
                </div>
                
                
                <x-footer />
               
            </div>
        </div>
    </div>
    
    @section('js')

        <script src="{{ asset('assets/vendors/select2/jquery.js') }}"></script>

       

        @if ($this->ujian->ujian_setting->urutan_pilihan == true)
        <script>
            $(document).ready(function () {
                $(document).bind('cut copy paste', function (e) {
                    e.preventDefault();
                });
                
                $(document).on("contextmenu",function(e){
                    return false;
                });
            });
        </script>            
        @endif
        

         @if ($openUjianForm)
           
            <script>
                var timeoutHandle;
                function countdown(minutes) {
                    var seconds = 60;
                    var mins = minutes
                    function tick() {
                        var counter = document.getElementById("timer");
                        var current_minutes = mins-1
                        seconds--;
                        counter.innerHTML =
                        current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
                        if( seconds > 0 ) {
                            timeoutHandle=setTimeout(tick, 1000);
                        } else {
                            if(mins > 1){
                            // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
                            setTimeout(function () { countdown(mins - 1); }, 1000);
                            }
                        }
                    }
                    tick();
                }

                var time = '{{$this->time}}';
                countdown(time);
            

            </script>

            <script type="text/javascript">
                var time = '{{$this->time}}';
                var params = '{{$this->ujian->id}}'
                var realtime = time*60000;
                setTimeout(function () {
                   alert('Time Out');
                },
            realtime);
                
            </script>


            <script type='text/javascript'>

                (function()
                {
                if( window.localStorage )
                {
                    if( !localStorage.getItem('firstLoad') )
                    {
                    localStorage['firstLoad'] = true;
                    window.location.reload();
                    }
                    else
                    localStorage.removeItem('firstLoad');
                }
                })();

            </script>

         @endif
    @endsection

</div>

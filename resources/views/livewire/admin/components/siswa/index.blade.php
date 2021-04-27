
@section('css')
    <style>
        #conCard:hover{
            cursor: pointer;
        }
    </style>
@endsection

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>Tugas Terbaru</h4>
                    <div>
                        <select wire:model='perPage' class="form-select">
                            <option value="3" selected>3</option>
                            <option value="5">5</option>
                            <option value="7">7</option>
                        </select>
                    </div>
                </div>
            </div>
          
           <div class="card-body">
            @forelse ($data['ujian'] as $item)
                <div id="conCard" style="background-color: #f0f0f0; border-radius:10px; padding:20px;">
                    <h5>{{ $item->judul }}</h5>
                    <hr>
                    <span>Guru : {{ $item->guru->nama }}</span><br>
                    <span>Mapel : {{ $item->mapel->nama }}</span><br>
                    <span>Waktu : {{ $item->ujian_setting->waktu }} Menit</span><br>
                    <span>Jumlah Soal : {{ $item->ujian_setting->jumlah_soal }}</span><br>
                    <span>Token : {{ $item->token }}</span>
                    {{-- <span>Token : {{ $item->token }}</span><br> --}}

                    <div class="d-flex justify-content-between">
                        <span></span>
                        <a href="dashboard/ujian/{{Str::slug($item->mapel->nama)}}/{{$item->id}}" class="btn btn-success btn-sm">Kerjakan</a>
                    </div>
                
                </div>
            @empty
                Tidak ada ujian
            @endforelse    
           </div>

          
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Status dan Nilai</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Mapel</th>
                                <th>Status</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['hasil'] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->ujian->judul }}</td>
                                    <td>
                                        {{ $item->ujian->mapel->nama }}
                                    </td>
                                    <td>
                                        @if ($item->status == true)
                                        <span class="badge bg-success">Dinilai</span>
                                    
                                        @else
                                                <span class="badge bg-warning">Cek</span>
                                        @endif
                                    </td>
                                    <td>
                                       @if ($item->ujian->ujian_setting->tampil_nilai == true)
                                            <span class="badge bg-primary">{{ $item->score }}/{{ $item->ujian->ujian_setting->jumlah_soal }}</span>
                                        @else
                                            Secret
                                       @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
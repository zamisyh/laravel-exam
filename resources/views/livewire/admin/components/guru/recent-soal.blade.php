<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>Recent Soal</h4>
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
                <div style="background-color:#f0f0f0; padding:30px; border-radius:10px;">
                    @foreach ($data['ujian'] as $item)
                    <hr>
                    <span>Judul : {{ $item->judul }}</span><br>
                    <span>Guru : {{ $item->guru->nama }}</span><br>
                    <span>Mapel : {{ $item->mapel->nama }}</span><br>
                    <span>Kelas : {{ $item->kelas->nama }} {{ $item->kelas->jurusan->alias }} {{ $item->kelas->no }}</span><br>
                    <span>Waktu : {{ $item->ujian_setting->waktu }} Menit</span><br>
                    <span>Token : {{ $item->token }}</span><br>
                    <span>Tanggal : {{ $item->tanggal_mulai }} - {{ $item->tanggal_akhir }}</span><br>
                    <span>Status : @if ($item->status == false)
                        <span class="badge bg-secondary">Draft</span class="status">
                    @else
                        <span class="badge bg-success">Active</span class="status">
                    @endif
                    </span>
                @endforeach
                
                </div>

                <div class="mt-4 mb-3">
                    {{ $data['ujian']->links() }}
                </div>
           </div>

          
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Activity Student</h4>
            </div>
            <div class="card-content pb-4">
                <div class="recent-message d-flex px-4 py-3">
                    <div class="avatar avatar-lg">
                        <img src="assets/images/faces/4.jpg">
                    </div>
                    <div class="name ms-4">
                        <h5 class="mb-1">Hank Schrader</h5>
                        <h6 class="text-muted mb-0">@johnducky</h6>
                    </div>
                </div>
                <div class="px-4">
                    <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>View More</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                            wire:model.lazy='judul'>
                            @error('judul') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="mapel">Mapel</label>
                            <select wire:model.lazy='mapel' class="form-select @error('judul') is-invalid @enderror">
                                <option value="" selected>Pilih</option>
                                @foreach ($data['mapelkelas'] as $item)
                                    @foreach ($item->mapel as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('mapel') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="mapel">Kelas</label>
                          
                                <select wire:model.lazy='kelas' class="form-select @error('judul') is-invalid @enderror">
                                    <option value="" selected>Pilih</option>
                                    @foreach ($data['mapelkelas'] as $item)
                                        @foreach ($item->kelas as $kelas)
                                            <option value="{{ $kelas->id }}">{{ $kelas->nama }} {{ $kelas->jurusan->alias }} {{ $kelas->no }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('kelas') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="mapel">Jumlah Soal</label>
                                <select wire:model.lazy='jumlah_soal' class="form-select @error('judul') is-invalid @enderror">
                                    <option value="" selected>Pilih</option>    
                                    <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="35">35</option>
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                </select>
                                @error('jumlah_soal') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                                <div class="form-group">
                                    <label for="waktu_mulai">Tanggal Mulai</label>
                                    <input wire:model.lazy='tanggal_mulai' type="date" class="form-control @error('judul') is-invalid @enderror">
                                    @error('tanggal_mulai') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="waktu_selesai">Tanggal Selesai</label>
                                    <input wire:model.lazy='tanggal_selesai' type="date" class="form-control @error('judul') is-invalid @enderror">
                                    @error('tanggal_selesai') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                               
                                 @if ($viewMoreSetting)
                                    <div class="form-group">
                                        <label for="from">Waktu</label>
                                        <input wire:model.lazy='waktu' type="number" class="form-control @error('judul') is-invalid @enderror" placeholder="Satuan menit, ex : 60">
                                        @error('waktu') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="token">Token</label>
                                        <input wire:model.lazy='token' type="text" class="form-control @error('judul') is-invalid @enderror">
                                        @error('token') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="acak_soal">Acak Soal</label>
                                            <div class="form-check">
                                                <input wire:model.lazy='acak_soal' class="form-check-input @error('acak_soal') is-invalid @enderror" type="radio" name="acak_soal"
                                                id="acak_soal1" value="1">
                                            <label class="form-check-label" for="acak_soal1">
                                                        Yes
                                        </label>
                                        </div>
                                        <div class="form-check">
                                            <input wire:model.lazy='acak_soal' class="form-check-input @error('acak_soal') is-invalid @enderror" type="radio" name="acak_soal"
                                                id="acak_soal1" value="0">
                                            <label class="form-check-label" for="acak_soal1">
                                                    No
                                            </label>
                                        </div>
                                        
                                        @error('acak_soal') <span class="text-danger">{{ $message }}</span> @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="acak_pilihan">Acak Pilihan</label>
                                            <div class="form-check">
                                                <input wire:model.lazy='acak_pilihan' class="form-check-input @error('acak_pilihan') is-invalid @enderror" type="radio" name="acak_pilihan"
                                                    id="acak_pilihan1" value="1">
                                                <label class="form-check-label" for="acak_pilihan1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input selected wire:model.lazy='acak_pilihan' class="form-check-input @error('acak_pilihan') is-invalid @enderror" type="radio" name="acak_pilihan"
                                                    id="acak_pilihan1" value="0">
                                                <label class="form-check-label" for="acak_pilihan1">
                                                    No
                                                </label>
                                            </div>

                                            @error('acak_pilihan') <span class="text-danger">{{ $message }}</span> @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="tampil_nilai">Tampilkan Nilai</label>
                                            <div class="form-check">
                                                <input wire:model.lazy='tampil_nilai' class="form-check-input @error('tampil_nilai') is-invalid @enderror" type="radio" name="tampil_nilai"
                                                    id="tampil_nilai1" value="1">
                                                <label class="form-check-label" for="tampil_nilai1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                            
                                                <input wire:model='tampil_nilai' class="form-check-input @error('tampil_nilai') is-invalid @enderror" type="radio" name="tampil_nilai"
                                                    id="tampil_nilai1" value="0">
                                                <label class="form-check-label" for="tampil_nilai1">
                                                    No
                                                </label>
                                            </div>
                                            @error('tampil_nilai') <span class="text-danger">{{ $message }}</span> @enderror

                                        </div>
                                    <div class="form-group">
                                        <button wire:loading.remove wire:click='saveUjian' class="btn btn-primary">Submit</button>
                                        <button wire:loading wire:target='saveUjian' class="btn btn-primary" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <button wire:loading.remove wire:click='activateLoadMore' class="btn btn-primary">Load More</button>
                                        <button wire:loading wire:target='activateLoadMore' class="btn btn-primary" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    </button>
                                </div>
                             @endif
                        </div>
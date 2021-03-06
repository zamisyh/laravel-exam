<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Data Soal</h4>
                    <div>
                        <select class="form-select" wire:model='pageSize'>
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @php
                
                  $soals = App\Models\soal::where('ujian_id', $ujianId)->with('ujian')->orderBy('id', 'ASC')->paginate($pageSize);
                @endphp

                @forelse ($soals as $key => $soal)
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span></span>
                        <div>
                            <span id="editSoal" wire:click='editSoal({{$soal->id}})'><i class="bi bi-pencil-square"></i></span>
                            <span id="deleteSoal" wire:click='deleteSoal({{$soal->id}})'><i class="bi bi-trash"></i></span>
                        </div>
                    </div>
                        <div class="form-group">
                            @if (!empty($soal->image))
                                <div class="container-fluid mb-5">
                                    <img src="{{ asset('storage/images/soal/' . $soal->image) }}" class="img-fluid rounded mx-auto d-block">
                                </div>
                            @endif
                            <div class="uraian">
                                {{ $soals->firstItem() + $key}} . 
                                <span>{{ $soal->uraian }}</span>
                                
                                <ul style="list-style: none; margin-top:10px;">
                                    <li @if ($soal->kunci == 'a') style="font-weight: 800; color: green" @endif>A. {{ $soal->opsi_a }}</li>
                                    <li @if ($soal->kunci == 'b') style="font-weight: 800; color: green" @endif>B. {{ $soal->opsi_b }}</li>
                                    <li @if ($soal->kunci == 'c') style="font-weight: 800; color: green" @endif>C. {{ $soal->opsi_c }}</li>
                                    <li @if ($soal->kunci == 'd') style="font-weight: 800; color: green" @endif>D. {{ $soal->opsi_d }}</li>
                                    <li @if ($soal->kunci == 'e') style="font-weight: 800; color: green" @endif>E. {{ $soal->opsi_e }}</li>
                                </ul>
                            </div>
                        </div>
                        


                    @empty

                        Soal Kosong, silahkan tambahkan soal terlebih dahulu
                @endforelse

                <div class="form-group">
                    {{ $soals->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Create Soal</h4>
                    <button class="btn btn-success btn-sm" wire:click='openFormExcel()'>Excel</button>
                </div> 
            </div>
            <div class="card-body">
                @if ($openCreateExcelForm)

                    <form wire:submit.prevent='upload_excel' enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="upload_excel">Upload Excel</label>
                            <input type="file" wire:model.lazy='file_excel' class="form-control mt-3 @error('file_excel') is-invalid @enderror">
                            @error('file_excel') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
    
                        <div class="form-group">
                            <a href="">Example Template</a>
                        </div>
                        
                        <button class="btn btn-primary">Upload</button>
                    </form>
                    

                @else
                    

                    <div class="form-group">
                        <label for="uraian">Uraian</label>
                        <textarea rows="5" class="form-control @error('uraian') is-invalid @enderror" wire:model.lazy='uraian'></textarea>
                        @error('uraian') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        

                        @if ($openGambarForn)
                            <label for="gambar">Gambar</label>
                            <input type="file" wire:model.lazy='gambar' class="form-control">
                            @error('gambar') <span class="text-danger">{{ $message }}</span>@enderror

                        <div wire:loading wire:target="gambar">
                                <span class="spinner-border" role="status"
                                aria-hidden="true"></span>
                                <span>Uploading</span>
                        </div>

                        <br>
                        
                        <div>
                                @if ($gambar)
                                    <img style="height: 100px" src="{{ $gambar->temporaryUrl() }}">
                                @endif
                        </div>
                        @else
                            <a href="#" wire:click='openGambarClick' class="text-primary">Tambah Gambar ?</a>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="kunci">Kunci Jawaban</label>
                        <select class="form-control @error('kunci') is-invalid @enderror" wire:model.lazy='kunci'>
                            <option value="" selected>Pilih</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>
                        @error('kunci') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="a">Opsi A</label>
                        <input class="form-control @error('a') is-invalid @enderror" wire:model.lazy='a'>
                        @error('a') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="b">Opsi B</label>
                        <input class="form-control @error('b') is-invalid @enderror" wire:model.lazy='b'>
                        @error('b') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="c">Opsi C</label>
                        <input class="form-control @error('c') is-invalid @enderror" wire:model.lazy='c'>
                        @error('c') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="d">Opsi D</label>
                        <input class="form-control @error('d') is-invalid @enderror" wire:model.lazy='d'>
                        @error('d') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="e">Opsi E</label>
                        <input class="form-control @error('e') is-invalid @enderror" wire:model.lazy='e'>
                        @error('e') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        @if ($openEditForm)
                            <button wire:loading.remove wire:click='updateSoal({{$editSoalId}})' class="btn btn-primary btn-block">Update</button>
                            <button wire:loading wire:target='updateSoal({{$editSoalId}})' class="btn btn-primary btn-block">Updating</button>
                        @else
                            <button wire:loading.remove wire:click='saveSoal' class="btn btn-primary btn-block">Save</button>
                            <button wire:loading wire:target='saveSoal' class="btn btn-primary btn-block">Saving</button>
                        @endif
                    </div>

                @endif
            </div>
        </div>
    </div>
</div>


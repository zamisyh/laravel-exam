<?php

namespace App\Exports;

use App\Models\hasil;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class HasilExport implements FromView
{

    public function __construct($id)
    {
        $this->id = $id;
    }


    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {

        return view('exports.hasil', [
            'hasil' => hasil::where('ujian_id', $this->id)->with('ujian.kelas.jurusan', 'siswa', 'ujian.mapel')->get()
        ]);
    }
}

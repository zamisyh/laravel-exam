<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\soal;

class SoalImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */

    public function __construct($ujian_id)
    {
        $this->ujian_id = $ujian_id;
    }

    public function model(array $row)
    {
        return new soal([
            'ujian_id' => $this->ujian_id,
            'uraian' => $row['uraian'],
            'kunci' => $row['kunci'],
            'opsi_a' => $row['option_a'],
            'opsi_b' => $row['option_b'],
            'opsi_c' => $row['option_c'],
            'opsi_d' => $row['option_d'],
            'opsi_e' => $row['option_e'],
        ]);
    }
}

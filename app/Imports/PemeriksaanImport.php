<?php

namespace App\Imports;

use App\Pemeriksaan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PemeriksaanImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $id = $row['no_pemeriksaan'];

            $pemeriksaan = Pemeriksaan::find($id);

            $pemeriksaan->hasil_pemeriksaan = $row['hasil_pemeriksaan'];

            $pemeriksaan->save();
        }
    }
}

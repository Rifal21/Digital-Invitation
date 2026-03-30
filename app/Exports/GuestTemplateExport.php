<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GuestTemplateExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            [
                'Nama' => 'Contoh: Budi Santoso',
                'Phone' => '08123456789',
                'Group' => 'Keluarga',
            ],
            [
                'Nama' => 'Ani Wijaya',
                'Phone' => '08987654321',
                'Group' => 'Teman Kantor',
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Phone',
            'Group',
        ];
    }
}

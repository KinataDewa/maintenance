<?php

namespace App\Exports;

use App\Models\MeteranListrikInduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MeteranIndukExport implements FromCollection, WithHeadings
{
    protected $tanggal;

    public function __construct($tanggal)
    {
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        $query = MeteranListrikInduk::query();

        if ($this->tanggal) {
            $query->whereDate('tanggal', $this->tanggal);
        }

        return $query->select('tanggal', 'jam', 'kwh', 'kvar', 'cosphi', 'keterangan')->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Jam', 'Kwh', 'Kvar', 'Cosphi', 'Keterangan'];
    }
}


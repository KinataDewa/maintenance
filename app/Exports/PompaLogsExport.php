<?php

namespace App\Exports;

use App\Models\PompaLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PompaLogsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return PompaLog::with(['pompaUnit', 'user'])->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Jenis Pompa',
            'Meteran',
            'Status',
            'Jam',
            'Deskripsi',
            'Foto',
            'User',
        ];
    }

    public function map($log): array
    {
        static $no = 1;
        return [
            $no++,
            $log->pompaUnit->nama_pompa,
            $log->meteran,
            $log->status,
            $log->jam ?? $log->created_at->format('H:i'),
            $log->deskripsi ?? '-',
            $log->foto ? url('storage/'.$log->foto) : '-',
            $log->user->name ?? '-',
        ];
    }
}

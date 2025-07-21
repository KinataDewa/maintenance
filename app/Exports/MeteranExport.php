<?php

namespace App\Exports;

use App\Models\MeteranListrik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;

class MeteranExport implements FromCollection, WithHeadings
{
    protected $tenant_id;
    protected $tanggal;

    public function __construct($tenant_id = null, $tanggal = null)
    {
        $this->tenant_id = $tenant_id;
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        $query = MeteranListrik::with('tenant')->latest();

        if ($this->tenant_id) {
            $query->where('tenant_id', $this->tenant_id);
        }

        if ($this->tanggal) {
            $query->whereDate('waktu_input', $this->tanggal);
        }

        return $query->get()->map(function ($item) {
            return [
                'Tanggal' => \Carbon\Carbon::parse($item->waktu_input)->format('Y-m-d'),
                'Tenant' => $item->tenant->nama ?? '-',
                'Kwh' => $item->kwh,
                'Deskripsi' => $item->deskripsi ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['Tanggal', 'Tenant', 'Kwh', 'Deskripsi'];
    }
}


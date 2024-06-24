<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Data;

class ArsipExport implements FromCollection, WithHeadings
{
    protected $arsip;

    public function __construct($arsip)
    {
        $this->arsip = $arsip;
    }

    public function collection()
    {
        return $this->arsip->map(function ($item) {
            return [
                $item->tanggal,
                $item->nomor_agenda,
                $item->nomor_surat,
                $item->perihal,
                optional($item->kategori)->kategori_surat ?? '',
                $item->asal_surat,
                $item->lampiran,
                optional($item->arsip)->tanggal_arsip ?? '', // Menggunakan optional() untuk mengatasi nilai null jika tidak ada relasi
                optional(optional($item->arsip)->rak)->nama_rak ?? '', // Menggunakan optional() untuk mengatasi nilai null jika tidak ada relasi
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal Surat Masuk',
            'Nomor Agenda',
            'Nomor Surat',
            'Perihal',
            'Kategori Surat',
            'Asal Surat',
            'Lampiran',
            'Tanggal Arsip',
            'Kode Rak',
        ];
    }
}
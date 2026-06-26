<?php

namespace App\Exports;

use App\Models\HasilEvaluasi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
{
    public function __construct(private ?int $idPolres = null)
    {
    }

    public function query()
    {
        $query = HasilEvaluasi::with(['responden.polres'])
            ->whereNotNull('skor_sus');

        if ($this->idPolres) {
            $query->whereHas('responden', fn($q) => $q->where('id_polres', $this->idPolres));
        }

        return $query->orderBy('id_hasil');
    }

    public function title(): string
    {
        return 'Rekap Evaluasi';
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Responden',
            'Polres',
            'Jabatan',
            'Lama Penggunaan',
            'Pelatihan SAKTI',
            'Skor Pemahaman',
            'Kategori Pemahaman',
            'Skor PU',
            'Skor PEOU',
            'Skor ATU',
            'Skor BI',
            'Skor TAM',
            'Kategori TAM',
            'Skor SUS',
            'Kategori SUS',
            'Tanggal Isi',
        ];
    }

    public function map($row): array
    {
        static $no = 0;
        $no++;

        $skorTAM = null;
        if ($row->skor_pu && $row->skor_peou && $row->skor_atu && $row->skor_bi) {
            $skorTAM = round(($row->skor_pu + $row->skor_peou + $row->skor_atu + $row->skor_bi) / 4, 2);
        }

        return [
            $no,
            $row->responden->kode_responden,
            $row->responden->polres->nama_polres ?? '-',
            $row->responden->jabatan,
            $row->responden->lama_penggunaan,
            $row->responden->pelatihan_sakti,
            $row->skor_pemahaman,
            $row->kategori_pemahaman,
            $row->skor_pu,
            $row->skor_peou,
            $row->skor_atu,
            $row->skor_bi,
            $skorTAM,
            $row->kategori_tam,
            $row->skor_sus,
            $row->kategori_sus,
            $row->created_at?->format('d/m/Y'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {

        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'name' => 'Inter'],
                'fill' => ['fillType' => 'solid', 'color' => ['argb' => 'FF1B3A5C']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }
}

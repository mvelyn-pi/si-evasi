<?php

namespace App\Services;

use App\Models\HasilEvaluasi;
use App\Models\Jawaban;
use Illuminate\Support\Facades\DB;

class SkoringService
{
    /**
     * Hitung skor Pemahaman Pengguna.
     */
    public function hitungPemahaman(int $idResponden): float
    {
        $jawabans = Jawaban::where('id_responden', $idResponden)
            ->whereHas('pertanyaan', fn($q) => $q->where('jenis_kuesioner', 'pemahaman'))
            ->get();

        if ($jawabans->isEmpty()) {
            return 0.0;
        }

        return round($jawabans->sum('skor') / $jawabans->count(), 2);
    }

    /**
     * Hitung skor TAM per konstruk dan keseluruhan.
     * @return array{pu: float, peou: float, atu: float, bi: float, keseluruhan: float}
     */
    public function hitungTAM(int $idResponden): array
    {
        $konstrukMap = [
            'pu'   => 'Perceived Usefulness',
            'peou' => 'Perceived Ease of Use',
            'atu'  => 'Attitude Toward Using',
            'bi'   => 'Behavioral Intention to Use',
        ];

        $result = [];

        foreach ($konstrukMap as $key => $konstrukNama) {
            $jawabans = Jawaban::where('id_responden', $idResponden)
                ->whereHas('pertanyaan', fn($q) => $q
                    ->where('jenis_kuesioner', 'tam')
                    ->where('konstruk', $konstrukNama)
                )
                ->get();

            $result[$key] = $jawabans->isEmpty()
                ? 0.0
                : round($jawabans->sum('skor') / $jawabans->count(), 2);
        }

        $result['keseluruhan'] = round(
            ($result['pu'] + $result['peou'] + $result['atu'] + $result['bi']) / 4,
            2
        );

        return $result;
    }

    /**
     * Hitung skor SUS menggunakan rumus standar System Usability Scale.
     */
    public function hitungSUS(int $idResponden): float
    {
        $jawabans = Jawaban::where('id_responden', $idResponden)
            ->whereHas('pertanyaan', fn($q) => $q->where('jenis_kuesioner', 'sus'))
            ->with('pertanyaan')
            ->get();

        if ($jawabans->isEmpty()) {
            return 0.0;
        }

        $totalKonversi = 0;

        foreach ($jawabans as $jawaban) {
            $nomorItem = $jawaban->pertanyaan->nomor_item;
            $skor = $jawaban->skor;

            if ($nomorItem % 2 !== 0) {
                // Item ganjil (positif)
                $totalKonversi += ($skor - 1);
            } else {
                // Item genap (reverse/negatif)
                $totalKonversi += (5 - $skor);
            }
        }

        return round($totalKonversi * 2.5, 2);
    }

    /**
     * Mapping skor ke kategori.
     *
     * @param float  $skor  Nilai skor
     * @param string $jenis 'pemahaman' | 'tam' | 'sus'
     */
    public function kategorikan(float $skor, string $jenis): string
    {
        if ($jenis === 'sus') {
            return match (true) {
                $skor >= 86 => 'Sangat Baik',
                $skor >= 71 => 'Baik',
                $skor >= 51 => 'Cukup',
                default     => 'Rendah',
            };
        }

        // Untuk 'pemahaman' dan 'tam' (skala Likert 1–5)
        return match (true) {
            $skor >= 4.21 => 'Sangat Tinggi',
            $skor >= 3.41 => 'Tinggi',
            $skor >= 2.61 => 'Cukup',
            $skor >= 1.81 => 'Rendah',
            default       => 'Sangat Rendah',
        };
    }

    /**
     * Hitung semua skor dan simpan ke tabel hasil_evaluasi.
     */
    public function simpanHasilEvaluasi(int $idResponden): HasilEvaluasi
    {
        return DB::transaction(function () use ($idResponden) {
            $skorPemahaman = $this->hitungPemahaman($idResponden);
            $skorTAM       = $this->hitungTAM($idResponden);
            $skorSUS       = $this->hitungSUS($idResponden);

            return HasilEvaluasi::updateOrCreate(
                ['id_responden' => $idResponden],
                [
                    'skor_pemahaman'    => $skorPemahaman > 0 ? $skorPemahaman : null,
                    'skor_pu'           => $skorTAM['pu'] > 0 ? $skorTAM['pu'] : null,
                    'skor_peou'         => $skorTAM['peou'] > 0 ? $skorTAM['peou'] : null,
                    'skor_atu'          => $skorTAM['atu'] > 0 ? $skorTAM['atu'] : null,
                    'skor_bi'           => $skorTAM['bi'] > 0 ? $skorTAM['bi'] : null,
                    'skor_sus'          => $skorSUS > 0 ? $skorSUS : null,
                    'kategori_pemahaman' => $skorPemahaman > 0 ? $this->kategorikan($skorPemahaman, 'pemahaman') : null,
                    'kategori_tam'      => $skorTAM['keseluruhan'] > 0 ? $this->kategorikan($skorTAM['keseluruhan'], 'tam') : null,
                    'kategori_sus'      => $skorSUS > 0 ? $this->kategorikan($skorSUS, 'sus') : null,
                ]
            );
        });
    }
}

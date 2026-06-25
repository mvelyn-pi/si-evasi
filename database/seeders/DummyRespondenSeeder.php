<?php

namespace Database\Seeders;

use App\Models\Jawaban;
use App\Models\Pertanyaan;
use App\Models\Responden;
use App\Services\SkoringService;
use Illuminate\Database\Seeder;

class DummyRespondenSeeder extends Seeder
{
    public function run(): void
    {
        $skoringService = new SkoringService();

        $jabatanList = [
            'Bendahara Pengeluaran', 'Kaur Keuangan', 'Pejabat Pembuat Komitmen',
            'Staf Keuangan', 'Pengelola Anggaran', 'Bendahara Penerimaan',
        ];

        $lamaList       = ['< 1 tahun', '1–3 tahun', '3–5 tahun', '> 5 tahun'];
        $frekuensiList  = ['Harian', 'Mingguan', 'Bulanan'];
        $pelatihanList  = ['Pernah', 'Belum'];

        // Buat 15 responden dummy dari 5 Polres berbeda
        $polresIds = \App\Models\Polres::limit(5)->pluck('id_polres')->toArray();
        $pertanyaans = Pertanyaan::aktif()->orderBy('jenis_kuesioner')->orderBy('nomor_item')->get();

        for ($i = 1; $i <= 15; $i++) {
            $count = \App\Models\Responden::count() + 1;
            $kode  = 'RSP-' . str_pad($count, 4, '0', STR_PAD_LEFT);

            $responden = Responden::create([
                'kode_responden'      => $kode,
                'id_polres'           => $polresIds[($i - 1) % count($polresIds)],
                'jabatan'             => $jabatanList[($i - 1) % count($jabatanList)],
                'lama_penggunaan'     => $lamaList[($i - 1) % count($lamaList)],
                'frekuensi_penggunaan'=> $frekuensiList[($i - 1) % count($frekuensiList)],
                'pelatihan_sakti'     => $pelatihanList[($i - 1) % count($pelatihanList)],
            ]);

            // Isi semua jawaban dengan skor bervariasi (3–5 untuk kesan positif)
            foreach ($pertanyaans as $pertanyaan) {
                $skor = rand(3, 5);
                Jawaban::create([
                    'id_responden'  => $responden->id_responden,
                    'id_pertanyaan' => $pertanyaan->id_pertanyaan,
                    'skor'          => $skor,
                ]);
            }

            // Hitung dan simpan skor
            $skoringService->simpanHasilEvaluasi($responden->id_responden);
        }
    }
}

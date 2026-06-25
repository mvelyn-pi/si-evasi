<?php

namespace Tests\Feature;

use App\Models\Pertanyaan;
use App\Models\Polres;
use App\Models\Responden;
use App\Services\SkoringService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkoringTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifikasi rumus SUS dengan data dummy yang sudah diketahui hasilnya.
     *
     * Contoh:
     *  - Item ganjil (1,3,5,7,9): skor = 4 → konversi = 4-1 = 3 (× 5 item = 15)
     *  - Item genap (2,4,6,8,10): skor = 2 → konversi = 5-2 = 3 (× 5 item = 15)
     *  - Total konversi = 30, Skor SUS = 30 × 2.5 = 75
     */
    public function test_hitung_sus_rumus_standar(): void
    {
        $polres    = Polres::factory()->create(['nama_polres' => 'Polres Test', 'wilayah' => 'Test']);
        $responden = Responden::factory()->create(['id_polres' => $polres->id_polres]);

        // Seed 10 pertanyaan SUS
        for ($i = 1; $i <= 10; $i++) {
            $p = Pertanyaan::create([
                'jenis_kuesioner' => 'sus',
                'konstruk'        => null,
                'nomor_item'      => $i,
                'teks_pertanyaan' => "Pertanyaan SUS no {$i}",
                'is_reverse'      => ($i % 2 === 0),
                'status'          => 'aktif',
            ]);

            // Item ganjil: skor 4, item genap: skor 2
            $skor = ($i % 2 !== 0) ? 4 : 2;
            \App\Models\Jawaban::create([
                'id_responden'  => $responden->id_responden,
                'id_pertanyaan' => $p->id_pertanyaan,
                'skor'          => $skor,
            ]);
        }

        $service = new SkoringService();
        $sus = $service->hitungSUS($responden->id_responden);

        // Verifikasi: (5×3 + 5×3) × 2.5 = 75
        $this->assertEquals(75.0, $sus);
    }

    /**
     * Verifikasi kasus ekstrem SUS: semua skor 5 untuk item ganjil, 1 untuk item genap.
     * Konversi ganjil: 5-1=4 (×5=20), genap: 5-1=4 (×5=20), total=40, SUS=40×2.5=100
     */
    public function test_sus_skor_maksimum(): void
    {
        $polres    = Polres::factory()->create(['nama_polres' => 'Polres Test 2', 'wilayah' => 'Test']);
        $responden = Responden::factory()->create(['id_polres' => $polres->id_polres]);

        for ($i = 1; $i <= 10; $i++) {
            $p = Pertanyaan::create([
                'jenis_kuesioner' => 'sus', 'konstruk' => null,
                'nomor_item' => $i, 'teks_pertanyaan' => "SUS {$i}",
                'is_reverse' => ($i % 2 === 0), 'status' => 'aktif',
            ]);
            $skor = ($i % 2 !== 0) ? 5 : 1;
            \App\Models\Jawaban::create(['id_responden' => $responden->id_responden, 'id_pertanyaan' => $p->id_pertanyaan, 'skor' => $skor]);
        }

        $sus = (new SkoringService())->hitungSUS($responden->id_responden);
        $this->assertEquals(100.0, $sus);
    }

    /**
     * Verifikasi kasus SUS minimum: semua skor 1 untuk item ganjil, 5 untuk item genap.
     * Konversi ganjil: 1-1=0 (×5=0), genap: 5-5=0 (×5=0), total=0, SUS=0
     */
    public function test_sus_skor_minimum(): void
    {
        $polres    = Polres::factory()->create(['nama_polres' => 'Polres Test 3', 'wilayah' => 'Test']);
        $responden = Responden::factory()->create(['id_polres' => $polres->id_polres]);

        for ($i = 1; $i <= 10; $i++) {
            $p = Pertanyaan::create([
                'jenis_kuesioner' => 'sus', 'konstruk' => null,
                'nomor_item' => $i, 'teks_pertanyaan' => "SUS {$i}",
                'is_reverse' => ($i % 2 === 0), 'status' => 'aktif',
            ]);
            $skor = ($i % 2 !== 0) ? 1 : 5;
            \App\Models\Jawaban::create(['id_responden' => $responden->id_responden, 'id_pertanyaan' => $p->id_pertanyaan, 'skor' => $skor]);
        }

        $sus = (new SkoringService())->hitungSUS($responden->id_responden);
        $this->assertEquals(0.0, $sus);
    }

    /**
     * Verifikasi kategorisasi SUS.
     */
    public function test_kategorisasi_sus(): void
    {
        $service = new SkoringService();
        $this->assertEquals('Rendah',      $service->kategorikan(45.0, 'sus'));
        $this->assertEquals('Cukup',       $service->kategorikan(65.0, 'sus'));
        $this->assertEquals('Baik',        $service->kategorikan(80.0, 'sus'));
        $this->assertEquals('Sangat Baik', $service->kategorikan(90.0, 'sus'));
    }

    /**
     * Verifikasi kategorisasi Pemahaman/TAM.
     */
    public function test_kategorisasi_pemahaman(): void
    {
        $service = new SkoringService();
        $this->assertEquals('Sangat Rendah', $service->kategorikan(1.5, 'pemahaman'));
        $this->assertEquals('Rendah',        $service->kategorikan(2.2, 'pemahaman'));
        $this->assertEquals('Cukup',         $service->kategorikan(3.0, 'pemahaman'));
        $this->assertEquals('Tinggi',        $service->kategorikan(3.8, 'pemahaman'));
        $this->assertEquals('Sangat Tinggi', $service->kategorikan(4.5, 'pemahaman'));
    }
}

<?php

namespace Tests\Feature;

use App\Models\Pertanyaan;
use App\Models\Polres;
use App\Models\Responden;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KuesionerFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->polres = Polres::factory()->create();

        // Seed pertanyaan
        Pertanyaan::create(['jenis_kuesioner' => 'pemahaman', 'nomor_item' => 1, 'teks_pertanyaan' => 'P1', 'status' => 'aktif']);
        Pertanyaan::create(['jenis_kuesioner' => 'tam', 'konstruk' => 'Perceived Usefulness', 'nomor_item' => 1, 'teks_pertanyaan' => 'T1', 'status' => 'aktif']);
        Pertanyaan::create(['jenis_kuesioner' => 'sus', 'nomor_item' => 1, 'teks_pertanyaan' => 'S1', 'is_reverse' => false, 'status' => 'aktif']);
    }

    public function test_responden_bisa_mengisi_data_diri_dan_dapat_kode()
    {
        $response = $this->post(route('kuesioner.storeMulai'), [
            'id_polres'            => $this->polres->id_polres,
            'jabatan'              => 'Staf IT',
            'lama_penggunaan'      => '1–3 tahun',
            'frekuensi_penggunaan' => 'Harian',
            'pelatihan_sakti'      => 'Pernah',
        ]);

        $this->assertDatabaseHas('respondens', ['jabatan' => 'Staf IT']);
        $responden = Responden::where('jabatan', 'Staf IT')->first();

        $response->assertRedirect(route('kuesioner.pemahaman', $responden->kode_responden));
    }

    public function test_flow_kuesioner_lengkap()
    {
        $responden = Responden::factory()->create(['id_polres' => $this->polres->id_polres]);
        $kode = $responden->kode_responden;

        $pPemahaman = Pertanyaan::where('jenis_kuesioner', 'pemahaman')->first();
        $pTam = Pertanyaan::where('jenis_kuesioner', 'tam')->first();
        $pSus = Pertanyaan::where('jenis_kuesioner', 'sus')->first();

        // Submit Pemahaman
        $response1 = $this->post(route('kuesioner.storePemahaman', $kode), [
            'jawaban' => [$pPemahaman->id_pertanyaan => 5]
        ]);
        $response1->assertRedirect(route('kuesioner.tam', $kode));
        $this->assertDatabaseHas('jawabans', ['id_responden' => $responden->id_responden, 'id_pertanyaan' => $pPemahaman->id_pertanyaan, 'skor' => 5]);

        // Submit TAM
        $response2 = $this->post(route('kuesioner.storeTam', $kode), [
            'jawaban' => [$pTam->id_pertanyaan => 4]
        ]);
        $response2->assertRedirect(route('kuesioner.sus', $kode));
        $this->assertDatabaseHas('jawabans', ['id_responden' => $responden->id_responden, 'id_pertanyaan' => $pTam->id_pertanyaan, 'skor' => 4]);

        // Submit SUS
        $response3 = $this->post(route('kuesioner.storeSus', $kode), [
            'jawaban' => [$pSus->id_pertanyaan => 3]
        ]);
        $response3->assertRedirect(route('kuesioner.selesai'));
        $this->assertDatabaseHas('jawabans', ['id_responden' => $responden->id_responden, 'id_pertanyaan' => $pSus->id_pertanyaan, 'skor' => 3]);

        // Cek hasil evaluasi sudah tergenerate
        $this->assertDatabaseHas('hasil_evaluasis', ['id_responden' => $responden->id_responden]);
    }
}

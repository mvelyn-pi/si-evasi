<?php

namespace Database\Factories;

use App\Models\Polres;
use App\Models\Responden;
use Illuminate\Database\Eloquent\Factories\Factory;

class RespondenFactory extends Factory
{
    protected $model = Responden::class;

    public function definition(): array
    {
        static $counter = 0;
        $counter++;

        return [
            'kode_responden'       => 'RSP-' . str_pad($counter, 4, '0', STR_PAD_LEFT),
            'id_polres'            => Polres::factory(),
            'jabatan'              => $this->faker->randomElement(['Bendahara Pengeluaran', 'Kaur Keuangan', 'Staf Keuangan']),
            'lama_penggunaan'      => $this->faker->randomElement(['< 1 tahun', '1–3 tahun', '3–5 tahun']),
            'frekuensi_penggunaan' => $this->faker->randomElement(['Harian', 'Mingguan', 'Bulanan']),
            'pelatihan_sakti'      => $this->faker->randomElement(['Pernah', 'Belum']),
        ];
    }
}

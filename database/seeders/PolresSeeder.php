<?php

namespace Database\Seeders;

use App\Models\Polres;
use Illuminate\Database\Seeder;

class PolresSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_polres' => 'Polres Makassar', 'wilayah' => 'Kota Makassar'],
            ['nama_polres' => 'Polres Gowa', 'wilayah' => 'Kabupaten Gowa'],
            ['nama_polres' => 'Polres Maros', 'wilayah' => 'Kabupaten Maros'],
            ['nama_polres' => 'Polres Takalar', 'wilayah' => 'Kabupaten Takalar'],
            ['nama_polres' => 'Polres Jeneponto', 'wilayah' => 'Kabupaten Jeneponto'],
            ['nama_polres' => 'Polres Bantaeng', 'wilayah' => 'Kabupaten Bantaeng'],
            ['nama_polres' => 'Polres Bulukumba', 'wilayah' => 'Kabupaten Bulukumba'],
            ['nama_polres' => 'Polres Sinjai', 'wilayah' => 'Kabupaten Sinjai'],
            ['nama_polres' => 'Polres Bone', 'wilayah' => 'Kabupaten Bone'],
            ['nama_polres' => 'Polres Soppeng', 'wilayah' => 'Kabupaten Soppeng'],
            ['nama_polres' => 'Polres Wajo', 'wilayah' => 'Kabupaten Wajo'],
            ['nama_polres' => 'Polres Sidrap', 'wilayah' => 'Kabupaten Sidenreng Rappang'],
            ['nama_polres' => 'Polres Pinrang', 'wilayah' => 'Kabupaten Pinrang'],
            ['nama_polres' => 'Polres Enrekang', 'wilayah' => 'Kabupaten Enrekang'],
            ['nama_polres' => 'Polres Palopo', 'wilayah' => 'Kota Palopo'],
            ['nama_polres' => 'Polres Luwu', 'wilayah' => 'Kabupaten Luwu'],
            ['nama_polres' => 'Polres Luwu Utara', 'wilayah' => 'Kabupaten Luwu Utara'],
            ['nama_polres' => 'Polres Luwu Timur', 'wilayah' => 'Kabupaten Luwu Timur'],
            ['nama_polres' => 'Polres Toraja Utara', 'wilayah' => 'Kabupaten Toraja Utara'],
            ['nama_polres' => 'Polres Tana Toraja', 'wilayah' => 'Kabupaten Tana Toraja'],
        ];

        foreach ($data as $item) {
            Polres::updateOrCreate(['nama_polres' => $item['nama_polres']], $item);
        }
    }
}

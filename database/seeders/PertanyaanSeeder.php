<?php

namespace Database\Seeders;

use App\Models\Pertanyaan;
use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    public function run(): void
    {
        // ─── PEMAHAMAN PENGGUNA (10 item) ────────────────────────────────────
        $pemahaman = [
            [1, 'Pemahaman fungsi aplikasi', 'Saya memahami tujuan utama penggunaan aplikasi SAKTI dalam pekerjaan administrasi keuangan.'],
            [2, 'Pemahaman fungsi aplikasi', 'Saya memahami manfaat aplikasi SAKTI dalam mendukung proses kerja.'],
            [3, 'Pemahaman menu dan fitur', 'Saya memahami fungsi menu utama yang terdapat pada aplikasi SAKTI.'],
            [4, 'Pemahaman menu dan fitur', 'Saya dapat membedakan fungsi setiap fitur yang sering digunakan pada aplikasi SAKTI.'],
            [5, 'Pemahaman alur input data', 'Saya memahami tahapan penginputan data pada aplikasi SAKTI.'],
            [6, 'Pemahaman alur input data', 'Saya memahami data apa saja yang harus disiapkan sebelum menggunakan aplikasi SAKTI.'],
            [7, 'Pemahaman proses pelaporan', 'Saya memahami proses pembuatan atau pengecekan laporan melalui aplikasi SAKTI.'],
            [8, 'Pemahaman proses pelaporan', 'Saya memahami hubungan antara data yang diinput dan laporan yang dihasilkan.'],
            [9, 'Pemahaman kendala dasar', 'Saya memahami langkah dasar yang perlu dilakukan jika terjadi kendala saat menggunakan aplikasi SAKTI.'],
            [10, 'Pemahaman kendala dasar', 'Saya mengetahui pihak atau unit yang dapat dihubungi ketika mengalami kendala penggunaan aplikasi SAKTI.'],
        ];

        foreach ($pemahaman as [$nomor, $konstruk, $teks]) {
            Pertanyaan::updateOrCreate(
                ['jenis_kuesioner' => 'pemahaman', 'nomor_item' => $nomor],
                ['konstruk' => $konstruk, 'teks_pertanyaan' => $teks, 'is_reverse' => false, 'status' => 'aktif']
            );
        }

        // ─── TAM (16 item, 4 konstruk) ───────────────────────────────────────
        $tam = [
            [1,  'Perceived Usefulness',       'Aplikasi SAKTI membantu saya menyelesaikan pekerjaan administrasi keuangan.'],
            [2,  'Perceived Usefulness',       'Aplikasi SAKTI membuat pekerjaan saya menjadi lebih efektif.'],
            [3,  'Perceived Usefulness',       'Aplikasi SAKTI membantu meningkatkan produktivitas kerja saya.'],
            [4,  'Perceived Usefulness',       'Aplikasi SAKTI membantu meningkatkan ketepatan hasil pekerjaan.'],
            [5,  'Perceived Ease of Use',      'Aplikasi SAKTI mudah dipelajari oleh pengguna.'],
            [6,  'Perceived Ease of Use',      'Aplikasi SAKTI mudah digunakan dalam pekerjaan sehari-hari.'],
            [7,  'Perceived Ease of Use',      'Menu dan fitur pada aplikasi SAKTI mudah dipahami.'],
            [8,  'Perceived Ease of Use',      'Saya dapat menggunakan aplikasi SAKTI tanpa kesulitan yang berarti.'],
            [9,  'Attitude Toward Using',      'Saya merasa penggunaan aplikasi SAKTI mendukung pekerjaan saya.'],
            [10, 'Attitude Toward Using',      'Saya merasa nyaman menggunakan aplikasi SAKTI.'],
            [11, 'Attitude Toward Using',      'Saya menilai aplikasi SAKTI penting untuk digunakan dalam pekerjaan.'],
            [12, 'Attitude Toward Using',      'Saya memiliki sikap positif terhadap penggunaan aplikasi SAKTI.'],
            [13, 'Behavioral Intention to Use','Saya berniat terus menggunakan aplikasi SAKTI dalam pekerjaan.'],
            [14, 'Behavioral Intention to Use','Saya akan tetap menggunakan aplikasi SAKTI apabila dibutuhkan dalam pekerjaan.'],
            [15, 'Behavioral Intention to Use','Saya bersedia menyarankan penggunaan aplikasi SAKTI kepada rekan kerja yang membutuhkan.'],
            [16, 'Behavioral Intention to Use','Saya bersedia meningkatkan kemampuan saya dalam menggunakan aplikasi SAKTI.'],
        ];

        foreach ($tam as [$nomor, $konstruk, $teks]) {
            Pertanyaan::updateOrCreate(
                ['jenis_kuesioner' => 'tam', 'nomor_item' => $nomor],
                ['konstruk' => $konstruk, 'teks_pertanyaan' => $teks, 'is_reverse' => false, 'status' => 'aktif']
            );
        }

        // ─── SUS (10 item, rumus standar) ────────────────────────────────────
        $sus = [
            [1,  'Saya merasa akan sering menggunakan aplikasi SAKTI.',                                              false],
            [2,  'Saya merasa aplikasi SAKTI terlalu rumit untuk digunakan.',                                        true],
            [3,  'Saya merasa aplikasi SAKTI mudah digunakan.',                                                      false],
            [4,  'Saya membutuhkan bantuan orang lain atau teknisi untuk menggunakan aplikasi SAKTI.',               true],
            [5,  'Saya merasa fitur-fitur aplikasi SAKTI berjalan dengan baik.',                                     false],
            [6,  'Saya merasa terdapat banyak ketidaksesuaian dalam aplikasi SAKTI.',                                true],
            [7,  'Saya merasa kebanyakan pengguna akan cepat memahami cara menggunakan aplikasi SAKTI.',             false],
            [8,  'Saya merasa aplikasi SAKTI membingungkan saat digunakan.',                                         true],
            [9,  'Saya merasa percaya diri saat menggunakan aplikasi SAKTI.',                                        false],
            [10, 'Saya perlu belajar banyak hal terlebih dahulu sebelum dapat menggunakan aplikasi SAKTI dengan baik.', true],
        ];

        foreach ($sus as [$nomor, $teks, $isReverse]) {
            Pertanyaan::updateOrCreate(
                ['jenis_kuesioner' => 'sus', 'nomor_item' => $nomor],
                ['konstruk' => null, 'teks_pertanyaan' => $teks, 'is_reverse' => $isReverse, 'status' => 'aktif']
            );
        }
    }
}

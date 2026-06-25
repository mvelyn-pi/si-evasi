# SI-EVASI (Sistem Evaluasi Aplikasi SAKTI)

Sistem informasi berbasis web untuk mengevaluasi penggunaan Aplikasi SAKTI di Kepolisian Resor jajaran Polda Sulawesi Selatan. Sistem ini menggunakan tiga instrumen pengukuran:
1. **Pemahaman Pengguna** (10 item)
2. **Technology Acceptance Model / TAM** (16 item dengan 4 konstruk: PU, PEOU, ATU, BI)
3. **System Usability Scale / SUS** (10 item)

## Fitur Utama

- **Kuesioner Publik**: Desain UI/UX menarik dengan progress bar, tanpa perlu login, menggunakan sistem *kode responden* anonim.
- **Skoring Otomatis**: Kalkulasi rumus standar internasional untuk SUS, serta rata-rata konversi skala Likert 1-5 untuk Pemahaman dan TAM.
- **Role-based Access**: Akses dibedakan antara `Admin` (akses penuh) dan `Evaluator` (hanya view dashboard & laporan).
- **Dashboard Analitik**: Visualisasi data menarik menggunakan Chart.js (Bar chart, Doughnut chart, Progress bar).
- **Export Laporan**: Fasilitas untuk export hasil rekapitulasi ke dalam format PDF (DomPDF) dan Excel (Maatwebsite Excel).

## Teknologi

- **Backend**: Laravel 11.x, PHP 8.3+, MySQL
- **Frontend**: Bootstrap 5, Alpine.js (untuk state kuesioner form)
- **Library**: Chart.js, DomPDF, Maatwebsite Laravel Excel

## Instalasi

1. Clone repositori ini.
2. Jalankan `composer install`.
3. Salin `.env.example` ke `.env` dan konfigurasikan database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=si_evasi
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate:fresh --seed
   ```
   *Seeder sudah termasuk data 20 Polres se-Sulsel, 36 pertanyaan kuesioner, dan 15 responden dummy untuk testing.*
5. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

## Akun Default

Setelah menjalankan seeder, gunakan akun berikut untuk login:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@sisakti.id` | `Admin@1234` |
| Evaluator | `evaluator@sisakti.id` | `Eval@1234` |

## Pengujian

Aplikasi ini dilengkapi dengan Feature Tests untuk memastikan integritas logika inti.
Jalankan perintah berikut untuk menjalankan test:

```bash
php artisan test
```

Test meliputi:
- `SkoringTest`: Verifikasi akurasi rumus System Usability Scale (SUS) dan pemetaan kategori.
- `KuesionerFlowTest`: Verifikasi alur pengisian dari Data Diri hingga Selesai.
- `AuthRoleTest`: Verifikasi hak akses antara Admin, Evaluator, dan Tamu.

---
*Dikembangkan untuk penelitian skripsi Prodi Informatika.*

# PROMPT UNTUK AI CODING AGENT
## Build: Sistem Evaluasi Berbasis Web — Pemahaman, TAM, dan SUS Aplikasi SAKTI

---

## 1. KONTEKS PROYEK

Bangun **aplikasi web full-stack** bernama **SISTEM EVALUASI SAKTI** (boleh disingkat *E-Saksi* atau nama lain yang relevan — agent bebas mengusulkan nama produk, tapi jangan ubah istilah teknis di bawah).

Sistem ini **BUKAN** aplikasi SAKTI itu sendiri. Sistem ini adalah **alat bantu evaluasi** independen untuk mengukur tiga hal pada personel Kepolisian Resor se-Sulawesi Selatan yang menggunakan/berkaitan dengan aplikasi SAKTI (Sistem Aplikasi Keuangan Tingkat Instansi milik Kementerian Keuangan RI):

1. **Pemahaman Pengguna** — kuesioner kustom (5 indikator, 10 item).
2. **Penerimaan Pengguna** — Technology Acceptance Model / TAM (4 konstruk, 16 item).
3. **Usability** — System Usability Scale / SUS (10 item standar).

Sistem **tidak terintegrasi** dengan database resmi SAKTI atau sistem Kementerian Keuangan. Sistem berdiri sendiri, hanya mengumpulkan jawaban kuesioner dari responden, menghitung skor otomatis, menampilkan dashboard, dan mencetak laporan.

Latar penelitian: tugas akhir/skripsi program studi Informatika. Build harus production-grade tapi tetap sederhana untuk dijalankan di lingkungan lokal (XAMPP/Laragon) dan mudah dipresentasikan/didemokan.

---

## 2. TECH STACK (WAJIB)

| Komponen | Teknologi |
|---|---|
| Bahasa backend | PHP |
| Framework | Laravel (gunakan versi LTS/stable terbaru yang tersedia) |
| Database | MySQL |
| Frontend | Blade templating + Bootstrap (boleh tambah Alpine.js bila perlu interaktivitas ringan) |
| Grafik dashboard | Chart.js |
| Export laporan | PDF (gunakan `barryvdh/laravel-dompdf` atau `mpdf`) dan Excel (`maatwebsite/excel`) |
| Auth | Laravel built-in auth / Laravel Breeze (role-based: admin, evaluator) |
| Server lokal target | XAMPP atau Laragon |

Jangan ganti stack ini kecuali memang tidak memungkinkan secara teknis — kalau harus mengganti, jelaskan alasannya secara eksplisit sebelum melanjutkan.

---

## 3. AKTOR SISTEM

| Aktor | Login? | Peran |
|---|---|---|
| **Admin** | Ya | Mengelola data Polres, data responden, master pertanyaan/instrumen kuesioner, akun evaluator, dan melihat seluruh laporan. |
| **Responden** | Tidak perlu login (atau login ringan via kode responden) | Mengisi data diri (anonim/berkode) dan mengisi 3 jenis kuesioner: Pemahaman, TAM, SUS. |
| **Evaluator** | Ya | Melihat dashboard, grafik, rekapitulasi skor, dan mengunduh laporan. Tidak mengelola data master. |
| **Pimpinan** | Read-only / opsional | Melihat ringkasan hasil evaluasi sebagai dasar rekomendasi pelatihan/pendampingan. Bisa diimplementasikan sebagai varian role evaluator dengan akses lebih terbatas (hanya ringkasan, tanpa fitur kelola). |

Privasi: gunakan **kode responden** (bukan nama asli) sebagai identitas utama di seluruh tampilan hasil/laporan, agar identitas personel tetap terjaga.

---

## 4. KEBUTUHAN FUNGSIONAL (WAJIB DIIMPLEMENTASIKAN SEMUA)

1. Login untuk admin dan evaluator (dengan role-based access control).
2. Halaman publik pengisian kuesioner untuk responden (tanpa harus login admin).
3. CRUD data Polres (nama Polres, wilayah).
4. CRUD data responden (kode responden, Polres, jabatan/fungsi, lama penggunaan SAKTI, frekuensi penggunaan, pernah/belum pelatihan SAKTI).
5. Form/halaman kuesioner Pemahaman Pengguna (10 item, skala 1–5).
6. Form/halaman kuesioner TAM (16 item, skala 1–5).
7. Form/halaman kuesioner SUS (10 item, skala 1–5).
8. Sistem menyimpan setiap jawaban item ke tabel `jawaban` (relasi ke responden & pertanyaan).
9. Sistem menghitung skor Pemahaman Pengguna otomatis setelah responden submit.
10. Sistem menghitung skor TAM otomatis per konstruk (PU, PEOU, ATU, BI) setelah responden submit.
11. Sistem menghitung skor SUS otomatis (rumus standar) setelah responden submit.
12. Dashboard evaluasi (untuk evaluator & admin) menampilkan: jumlah responden, jumlah Polres, rata-rata skor Pemahaman, rata-rata skor TAM (per konstruk & keseluruhan), rata-rata skor SUS, grafik perbandingan, rekap per Polres dan per jabatan.
13. Grafik hasil evaluasi (Chart.js): bar/line chart per Polres, per jabatan/fungsi pengguna, distribusi kategori (Sangat Rendah–Sangat Tinggi / Rendah–Sangat Baik untuk SUS).
14. Generate laporan evaluasi dalam format PDF dan Excel (rekapitulasi skor seluruh responden + ringkasan agregat).
15. Master data pertanyaan kuesioner dikelola admin (tabel `pertanyaan`, bisa aktif/nonaktif per item, dikelompokkan per `jenis_kuesioner`: pemahaman / TAM / SUS).
16. Halaman ringkasan untuk pimpinan: kesimpulan kategori keseluruhan + rekomendasi tindak lanjut (pelatihan/pendampingan) berbasis skor (boleh teks otomatis berdasarkan kategori, atau field rekomendasi yang diisi evaluator/admin).

## 5. KEBUTUHAN NON-FUNGSIONAL

- **Keamanan**: autentikasi pengguna (admin/evaluator) + hashing password, pembagian hak akses berbasis role (middleware Laravel).
- **Kemudahan**: UI sederhana, form kuesioner mobile-friendly (one question per scroll section atau grouped per konstruk, jelas progress-nya).
- **Kinerja**: query dashboard dioptimasi (gunakan eager loading / agregasi query, hindari N+1).
- **Kompatibilitas**: responsif, bisa diakses dari laptop maupun ponsel (mengingat responden tersebar di berbagai Polres).
- **Keandalan**: validasi input di setiap form kuesioner agar tidak ada item yang terlewat sebelum submit.
- **Privasi**: tidak ada field nama asli responden yang ditampilkan di laporan/dashboard — gunakan `kode_responden`.

---

## 6. SKEMA DATABASE (GUNAKAN INI SEBAGAI ACUAN MIGRATION LARAVEL)

### 6.1 Tabel `users`
| Field | Tipe | Keterangan |
|---|---|---|
| id_user (PK) | bigint, auto-increment | |
| nama | varchar | |
| email | varchar, unique | |
| password | varchar (hashed) | |
| role | enum('admin','evaluator') | |
| created_at, updated_at | timestamp | |

### 6.2 Tabel `polres`
| Field | Tipe | Keterangan |
|---|---|---|
| id_polres (PK) | bigint, auto-increment | |
| nama_polres | varchar | |
| wilayah | varchar | |
| created_at, updated_at | timestamp | |

### 6.3 Tabel `responden`
| Field | Tipe | Keterangan |
|---|---|---|
| id_responden (PK) | bigint, auto-increment | |
| kode_responden | varchar, unique | kode anonim, generate otomatis (mis. RSP-0001) |
| id_polres (FK → polres) | bigint | |
| jabatan | varchar | jabatan/fungsi pengguna terkait SAKTI |
| lama_penggunaan | varchar | mis. "< 1 tahun", "1–3 tahun", dst |
| frekuensi_penggunaan | varchar | mis. "Harian", "Mingguan", "Bulanan" |
| pelatihan_sakti | enum('Pernah','Belum') | |
| created_at, updated_at | timestamp | |

### 6.4 Tabel `pertanyaan`
| Field | Tipe | Keterangan |
|---|---|---|
| id_pertanyaan (PK) | bigint, auto-increment | |
| jenis_kuesioner | enum('pemahaman','tam','sus') | |
| konstruk | varchar | nullable untuk SUS; isi nama indikator/konstruk |
| nomor_item | int | urutan tampil |
| teks_pertanyaan | text | |
| is_reverse | boolean | true untuk item SUS bernomor genap (item negatif/reverse-scored) |
| status | enum('aktif','nonaktif') | default aktif |

### 6.5 Tabel `jawaban`
| Field | Tipe | Keterangan |
|---|---|---|
| id_jawaban (PK) | bigint, auto-increment | |
| id_responden (FK) | bigint | |
| id_pertanyaan (FK) | bigint | |
| skor | tinyint | nilai 1–5 sesuai skala Likert |
| created_at | timestamp | |

### 6.6 Tabel `hasil_evaluasi`
| Field | Tipe | Keterangan |
|---|---|---|
| id_hasil (PK) | bigint, auto-increment | |
| id_responden (FK, unique) | bigint | |
| skor_pemahaman | decimal(4,2) | rata-rata 1.00–5.00 |
| skor_pu | decimal(4,2) | Perceived Usefulness |
| skor_peou | decimal(4,2) | Perceived Ease of Use |
| skor_atu | decimal(4,2) | Attitude Toward Using |
| skor_bi | decimal(4,2) | Behavioral Intention to Use |
| skor_sus | decimal(5,2) | 0.00–100.00 |
| kategori_pemahaman | varchar | hasil mapping kategori |
| kategori_tam | varchar | hasil mapping kategori (boleh per konstruk + 1 kategori keseluruhan) |
| kategori_sus | varchar | hasil mapping kategori |
| created_at, updated_at | timestamp | |

> Buat relasi Eloquent yang sesuai (`hasMany`, `belongsTo`) dan gunakan database transaction saat menyimpan jawaban + menghitung hasil_evaluasi sekaligus (agar konsisten).

---

## 7. INSTRUMEN KUESIONER — WAJIB DI-SEED PERSIS SEPERTI INI

Buat **database seeder** (`PertanyaanSeeder`) yang mengisi tabel `pertanyaan` dengan seluruh item berikut, persis urutan dan teksnya (boleh disesuaikan tipo kecil, tapi jangan ubah makna).

### 7.1 Kuesioner Pemahaman Pengguna (jenis_kuesioner = 'pemahaman')

| No | Konstruk/Indikator | Pernyataan |
|---|---|---|
| 1 | Pemahaman fungsi aplikasi | Saya memahami tujuan utama penggunaan aplikasi SAKTI dalam pekerjaan administrasi keuangan. |
| 2 | Pemahaman fungsi aplikasi | Saya memahami manfaat aplikasi SAKTI dalam mendukung proses kerja. |
| 3 | Pemahaman menu dan fitur | Saya memahami fungsi menu utama yang terdapat pada aplikasi SAKTI. |
| 4 | Pemahaman menu dan fitur | Saya dapat membedakan fungsi setiap fitur yang sering digunakan pada aplikasi SAKTI. |
| 5 | Pemahaman alur input data | Saya memahami tahapan penginputan data pada aplikasi SAKTI. |
| 6 | Pemahaman alur input data | Saya memahami data apa saja yang harus disiapkan sebelum menggunakan aplikasi SAKTI. |
| 7 | Pemahaman proses pelaporan | Saya memahami proses pembuatan atau pengecekan laporan melalui aplikasi SAKTI. |
| 8 | Pemahaman proses pelaporan | Saya memahami hubungan antara data yang diinput dan laporan yang dihasilkan. |
| 9 | Pemahaman kendala dasar | Saya memahami langkah dasar yang perlu dilakukan jika terjadi kendala saat menggunakan aplikasi SAKTI. |
| 10 | Pemahaman kendala dasar | Saya mengetahui pihak atau unit yang dapat dihubungi ketika mengalami kendala penggunaan aplikasi SAKTI. |

**Rumus skor:** `Skor Pemahaman = Total skor jawaban / 10`

**Kategori:**
| Rentang | Kategori |
|---|---|
| 1.00–1.80 | Sangat Rendah |
| 1.81–2.60 | Rendah |
| 2.61–3.40 | Cukup |
| 3.41–4.20 | Tinggi |
| 4.21–5.00 | Sangat Tinggi |

### 7.2 Kuesioner Technology Acceptance Model (jenis_kuesioner = 'tam')

| No | Konstruk | Indikator | Pernyataan |
|---|---|---|---|
| 1 | Perceived Usefulness | Manfaat pekerjaan | Aplikasi SAKTI membantu saya menyelesaikan pekerjaan administrasi keuangan. |
| 2 | Perceived Usefulness | Efektivitas kerja | Aplikasi SAKTI membuat pekerjaan saya menjadi lebih efektif. |
| 3 | Perceived Usefulness | Produktivitas kerja | Aplikasi SAKTI membantu meningkatkan produktivitas kerja saya. |
| 4 | Perceived Usefulness | Kualitas hasil kerja | Aplikasi SAKTI membantu meningkatkan ketepatan hasil pekerjaan. |
| 5 | Perceived Ease of Use | Kemudahan dipelajari | Aplikasi SAKTI mudah dipelajari oleh pengguna. |
| 6 | Perceived Ease of Use | Kemudahan digunakan | Aplikasi SAKTI mudah digunakan dalam pekerjaan sehari-hari. |
| 7 | Perceived Ease of Use | Kejelasan menu | Menu dan fitur pada aplikasi SAKTI mudah dipahami. |
| 8 | Perceived Ease of Use | Kemudahan interaksi | Saya dapat menggunakan aplikasi SAKTI tanpa kesulitan yang berarti. |
| 9 | Attitude Toward Using | Sikap positif | Saya merasa penggunaan aplikasi SAKTI mendukung pekerjaan saya. |
| 10 | Attitude Toward Using | Kenyamanan sikap | Saya merasa nyaman menggunakan aplikasi SAKTI. |
| 11 | Attitude Toward Using | Penilaian terhadap sistem | Saya menilai aplikasi SAKTI penting untuk digunakan dalam pekerjaan. |
| 12 | Attitude Toward Using | Kesediaan menggunakan | Saya memiliki sikap positif terhadap penggunaan aplikasi SAKTI. |
| 13 | Behavioral Intention to Use | Niat penggunaan | Saya berniat terus menggunakan aplikasi SAKTI dalam pekerjaan. |
| 14 | Behavioral Intention to Use | Keberlanjutan penggunaan | Saya akan tetap menggunakan aplikasi SAKTI apabila dibutuhkan dalam pekerjaan. |
| 15 | Behavioral Intention to Use | Rekomendasi penggunaan | Saya bersedia menyarankan penggunaan aplikasi SAKTI kepada rekan kerja yang membutuhkan. |
| 16 | Behavioral Intention to Use | Komitmen penggunaan | Saya bersedia meningkatkan kemampuan saya dalam menggunakan aplikasi SAKTI. |

**Rumus skor per konstruk:** `Skor Konstruk = Total skor item konstruk / Jumlah item konstruk` (masing-masing 4 item per konstruk)

**Kategori (berlaku untuk setiap konstruk maupun skor TAM keseluruhan):**
| Rentang | Kategori |
|---|---|
| 1.00–1.80 | Sangat Rendah |
| 1.81–2.60 | Rendah |
| 2.61–3.40 | Cukup |
| 3.41–4.20 | Tinggi |
| 4.21–5.00 | Sangat Tinggi |

### 7.3 Kuesioner System Usability Scale (jenis_kuesioner = 'sus')

| No | Pernyataan | is_reverse |
|---|---|---|
| 1 | Saya merasa akan sering menggunakan aplikasi SAKTI. | false |
| 2 | Saya merasa aplikasi SAKTI terlalu rumit untuk digunakan. | true |
| 3 | Saya merasa aplikasi SAKTI mudah digunakan. | false |
| 4 | Saya membutuhkan bantuan orang lain atau teknisi untuk menggunakan aplikasi SAKTI. | true |
| 5 | Saya merasa fitur-fitur aplikasi SAKTI berjalan dengan baik. | false |
| 6 | Saya merasa terdapat banyak ketidaksesuaian dalam aplikasi SAKTI. | true |
| 7 | Saya merasa kebanyakan pengguna akan cepat memahami cara menggunakan aplikasi SAKTI. | false |
| 8 | Saya merasa aplikasi SAKTI membingungkan saat digunakan. | true |
| 9 | Saya merasa percaya diri saat menggunakan aplikasi SAKTI. | false |
| 10 | Saya perlu belajar banyak hal terlebih dahulu sebelum dapat menggunakan aplikasi SAKTI dengan baik. | true |

**Rumus skor SUS (WAJIB persis seperti ini, ini adalah rumus standar SUS):**
```
Untuk item bernomor GANJIL (1,3,5,7,9): nilai_konversi = skor_responden - 1
Untuk item bernomor GENAP (2,4,6,8,10): nilai_konversi = 5 - skor_responden
Skor SUS = (jumlah seluruh nilai_konversi) * 2.5
```
Hasil akhir berada di rentang 0–100.

**Kategori SUS:**
| Rentang Skor | Kategori |
|---|---|
| 0–50 | Rendah |
| 51–70 | Cukup |
| 71–85 | Baik |
| 86–100 | Sangat Baik |

> Catatan implementasi: di tabel `pertanyaan`, gunakan `nomor_item` (1–10) untuk menentukan ganjil/genap secara otomatis saat kalkulasi, dan simpan juga `is_reverse` sebagai redundansi yang memudahkan query.

---

## 8. LOGIKA KALKULASI SKOR (BACKEND — IMPLEMENTASIKAN SEBAGAI SERVICE CLASS)

Buat service/class terpisah, misalnya `App\Services\SkoringService`, dengan method:

- `hitungPemahaman(int $idResponden): float` → rata-rata skor 10 item pemahaman.
- `hitungTAM(int $idResponden): array` → return array berisi skor PU, PEOU, ATU, BI (masing-masing rata-rata 4 item) + skor TAM keseluruhan (rata-rata dari 16 item atau rata-rata 4 konstruk — pilih salah satu pendekatan dan konsisten, sebutkan di komentar kode).
- `hitungSUS(int $idResponden): float` → terapkan rumus ganjil/genap di atas, kalikan 2.5.
- `kategorikan(float $skor, string $jenis): string` → mapping ke kategori sesuai tabel masing-masing jenis ('pemahaman'/'tam' pakai skala 1–5, 'sus' pakai skala 0–100).
- `simpanHasilEvaluasi(int $idResponden): HasilEvaluasi` → panggil ketiga method di atas, simpan/`updateOrCreate` ke tabel `hasil_evaluasi`.

Panggil `simpanHasilEvaluasi()` otomatis (via event/listener atau langsung di controller) setiap kali responden menyelesaikan ketiga kuesioner (atau setiap submit kuesioner — sebutkan keputusan desainmu di komentar/README).

---

## 9. STRUKTUR HALAMAN (ROUTING TINGKAT TINGGI)

**Publik (tanpa login):**
- `/` — landing page singkat: penjelasan tujuan evaluasi + tombol "Isi Kuesioner".
- `/kuesioner/mulai` — form data diri responden (pilih Polres, jabatan, lama/frekuensi penggunaan, status pelatihan) → generate `kode_responden`.
- `/kuesioner/pemahaman/{kode_responden}` — form 10 item pemahaman.
- `/kuesioner/tam/{kode_responden}` — form 16 item TAM (boleh dikelompokkan per konstruk).
- `/kuesioner/sus/{kode_responden}` — form 10 item SUS.
- `/kuesioner/selesai` — halaman terima kasih.

**Admin (login, role admin):**
- `/admin/dashboard`
- `/admin/polres` (CRUD)
- `/admin/responden` (index, detail, hapus — biasanya tidak ada create manual karena diisi responden sendiri)
- `/admin/pertanyaan` (CRUD per jenis kuesioner, toggle aktif/nonaktif)
- `/admin/users` (kelola akun evaluator)
- `/admin/laporan` (lihat + export PDF/Excel)

**Evaluator (login, role evaluator):**
- `/evaluator/dashboard` (grafik & rekap, lihat poin 12–13 di Kebutuhan Fungsional)
- `/evaluator/laporan` (export PDF/Excel)

**Pimpinan (opsional, bisa pakai role evaluator dengan view terbatas):**
- `/pimpinan/ringkasan` — ringkasan kategori keseluruhan + rekomendasi tindak lanjut.

---

## 10. KOMPONEN DASHBOARD (DETAIL)

Tampilkan minimal:
- Card: Total Responden, Total Polres, Rata-rata Skor Pemahaman, Rata-rata Skor TAM, Rata-rata Skor SUS.
- Bar chart: rata-rata skor (Pemahaman/TAM/SUS) per Polres.
- Bar/pie chart: distribusi kategori SUS (Rendah/Cukup/Baik/Sangat Baik).
- Bar chart: rata-rata 4 konstruk TAM (PU, PEOU, ATU, BI).
- Tabel rekapitulasi: kode responden, Polres, jabatan, skor pemahaman, skor TAM, skor SUS, kategori masing-masing.
- Tombol filter: per Polres, per rentang tanggal pengisian, per jabatan.

---

## 11. TESTING (BLACK BOX) — BUAT TEST CASE / FEATURE TEST UNTUK INI

| Fitur | Skenario | Hasil yang Diharapkan |
|---|---|---|
| Login admin | Email & password benar | Masuk ke dashboard admin |
| Login admin | Email/password salah | Pesan gagal login |
| Data Polres | Tambah data Polres | Data tersimpan dan tampil di list |
| Data responden | Isi data diri | Data tersimpan, kode responden ter-generate |
| Kuesioner pemahaman | Isi semua 10 item | Jawaban tersimpan ke tabel `jawaban` |
| Kuesioner TAM | Isi semua 16 item | Jawaban tersimpan |
| Kuesioner SUS | Isi semua 10 item | Jawaban tersimpan |
| Perhitungan skor | Setelah semua kuesioner terisi | Skor pemahaman, TAM (4 konstruk), dan SUS muncul benar di `hasil_evaluasi` |
| Dashboard | Evaluator membuka dashboard | Grafik dan rekap tampil sesuai data |
| Laporan | Evaluator unduh laporan | File PDF/Excel berhasil ter-generate dan berisi data yang benar |

Tulis minimal Feature Test Laravel (`php artisan make:test`) untuk: alur submit ketiga kuesioner + verifikasi hasil kalkulasi skor SUS dengan data dummy (agar rumus 100% benar — ini paling kritis untuk dicek manual karena ada perhitungan reverse-score).

---

## 12. DELIVERABLE YANG DIHARAPKAN DARI AGENT

1. Project Laravel lengkap (migration, model, seeder, controller, routes, views Blade).
2. README.md berisi: cara instalasi (composer install, .env setup, migrate --seed, npm install jika ada), kredensial akun default (admin & evaluator demo), dan penjelasan singkat struktur folder.
3. Seeder akun default: 1 admin (`admin@example.com` / password yang diberi tahu di README) dan 1 evaluator demo.
4. Seeder pertanyaan (36 item total: 10 pemahaman + 16 TAM + 10 SUS) sesuai isi Bagian 7.
5. Minimal 3–5 data dummy Polres dan beberapa data dummy responden + jawaban (agar dashboard tidak kosong saat demo pertama kali).
6. Tampilan UI rapi (boleh pakai theme admin Bootstrap gratis seperti AdminLTE/Argon, atau custom sederhana) — prioritaskan fungsi berjalan benar di atas estetika.

---

## 13. BATASAN / YANG TIDAK PERLU DIBUAT

- Jangan membangun ulang atau memodifikasi aplikasi SAKTI resmi — sistem ini berdiri sendiri.
- Jangan menambahkan integrasi API ke sistem Kementerian Keuangan/SAKTI.
- Tidak perlu mengukur performa teknis SAKTI (server, keamanan jaringan, dll) — itu di luar lingkup.
- Tidak perlu sistem notifikasi WhatsApp/email kompleks (berbeda dari proyek lain yang mungkin pernah dikerjakan sebelumnya — fokus hanya pada modul evaluasi ini).

---

### Catatan untuk Agent
Jika ada bagian yang ambigu (misalnya pendekatan kalkulasi skor TAM keseluruhan: rata-rata dari 16 item langsung vs rata-rata dari 4 skor konstruk), pilih satu pendekatan yang paling umum dipakai dalam literatur TAM (rata-rata dari skor konstruk), dokumentasikan keputusan tersebut di README, dan tetap konsisten di seluruh sistem.
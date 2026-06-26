# SI-EVASI — Sistem Evaluasi Aplikasi SAKTI

Sistem informasi berbasis web untuk mengevaluasi penggunaan Aplikasi SAKTI di Kepolisian Resor jajaran Polda Sulawesi Selatan. Sistem ini menggunakan tiga instrumen pengukuran:

1. **Pemahaman Pengguna** (10 item)
2. **Technology Acceptance Model / TAM** (16 item dengan 4 konstruk: PU, PEOU, ATU, BI)
3. **System Usability Scale / SUS** (10 item)

---

## Fitur Utama

- **Kuesioner Publik**: Desain UI/UX menarik dengan progress bar, tanpa perlu login, menggunakan sistem *kode responden* anonim.
- **Skoring Otomatis**: Kalkulasi rumus standar internasional untuk SUS, serta rata-rata konversi skala Likert 1–5 untuk Pemahaman dan TAM.
- **Role-based Access**: Akses dibedakan antara `Admin` (akses penuh) dan `Evaluator` (hanya view dashboard & laporan).
- **Dashboard Analitik**: Visualisasi data menggunakan Chart.js (Bar chart, Doughnut chart, Progress bar).
- **Export Laporan**: Export rekapitulasi ke format PDF (DomPDF) dan Excel (Maatwebsite Excel).

---

## Teknologi

| Lapisan | Teknologi |
|---|---|
| Backend | Laravel 13, PHP 8.3+, MySQL |
| Frontend | Bootstrap 5, Alpine.js, Tailwind CSS v3 dan Bootstrap 5 |
| Build Tool | Vite 8 |
| Library | Chart.js, DomPDF, Maatwebsite Laravel Excel |
| Server Lokal | XAMPP (Apache + MySQL) |

---

## Prasyarat

Pastikan semua perangkat lunak berikut sudah terinstal sebelum memulai:

| Perangkat Lunak | Versi Minimum | Link Download |
|---|---|---|
| **XAMPP** | 8.2+ (PHP 8.3) | https://www.apachefriends.org |
| **Composer** | 2.x | https://getcomposer.org/download |
| **Node.js & npm** | Node 20 LTS | https://nodejs.org |
| **Git** | Terbaru | https://git-scm.com/downloads |

### Cara Cek apakah sudah terinstal

Buka **Command Prompt** atau **Git Bash**, lalu jalankan:

```bash
php -v
composer -v
node -v
npm -v
git -v
```

Jika salah satu menampilkan pesan *"command not found"* atau *"not recognized"*, ikuti panduan instalasi di bawah.

---

## Panduan Instalasi Prasyarat

### 1. Instalasi XAMPP

1. Unduh XAMPP dari https://www.apachefriends.org (pilih versi dengan PHP 8.3).
2. Jalankan installer dan ikuti langkah instalasi (biarkan komponen default: Apache, MySQL, PHP, phpMyAdmin).
3. Setelah selesai, buka **XAMPP Control Panel** dan klik **Start** pada **Apache** dan **MySQL**.
4. Pastikan PHP sudah tersedia di PATH system agar bisa diakses dari terminal:
   - Buka *System Environment Variables* → *Path* → tambahkan `C:\xampp\php`.
   - Restart Command Prompt setelah menambahkan.

### 2. Instalasi Composer (jika belum ada)

Composer adalah dependency manager untuk PHP, dibutuhkan untuk menginstal paket Laravel.

1. Unduh **Composer-Setup.exe** dari https://getcomposer.org/download.
2. Jalankan installer — ia akan otomatis mendeteksi `php.exe` dari XAMPP.
3. Setelah selesai, verifikasi dengan:
   ```bash
   composer -v
   ```
   Jika muncul daftar perintah Composer, instalasi berhasil.

> **Catatan**: Jika installer tidak menemukan PHP otomatis, arahkan secara manual ke `C:\xampp\php\php.exe`.

### 3. Instalasi Node.js

1. Unduh **Node.js LTS** dari https://nodejs.org.
2. Jalankan installer (pastikan opsi *"Add to PATH"* dicentang).
3. Verifikasi:
   ```bash
   node -v
   npm -v
   ```

### 4. Instalasi Git

1. Unduh Git dari https://git-scm.com/downloads.
2. Jalankan installer (pilihan default sudah cukup).
3. Verifikasi:
   ```bash
   git -v
   ```

---

## Instalasi Proyek

### Opsi A: Melalui Git Clone (Direkomendasikan)

Buka **Command Prompt** atau **Git Bash**, lalu:

```bash
# Pindah ke direktori htdocs XAMPP
cd C:\xampp\htdocs

# Clone repositori
git clone https://github.com/mvelyn-pi/si-evasi.git

# Masuk ke folder proyek
cd SI-EVASI
```

---

### Opsi B: Melalui Download ZIP

1. Buka halaman repositori di GitHub.
2. Klik tombol **Code** → **Download ZIP**.
3. Ekstrak file ZIP yang diunduh.
4. Pindahkan folder hasil ekstrak ke `C:\xampp\htdocs\SI-EVASI`.
5. Buka **Command Prompt** dan masuk ke folder tersebut:
   ```bash
   cd C:\xampp\htdocs\SI-EVASI
   ```

---

### Langkah Setup Setelah Clone / Extract

#### 1. Instal Dependensi PHP (Composer)

```bash
composer install
```

> Proses ini akan mengunduh semua library Laravel dan package yang dibutuhkan ke folder `vendor/`. Pastikan koneksi internet aktif.

#### 2. Instal Dependensi Frontend (Node.js)

```bash
npm install
```

#### 3. Salin File Konfigurasi Environment

```bash
cp .env.example .env
```

> Di Windows Command Prompt (bukan Git Bash), gunakan:
> ```cmd
> copy .env.example .env
> ```

#### 4. Konfigurasi Database

Buka file `.env` menggunakan teks editor (Notepad, VS Code, dll.), lalu ubah bagian database:

```env
APP_NAME="SI-EVASI"
APP_URL=http://localhost/SI-EVASI/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=si_evasi
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan XAMPP**: Secara default, MySQL XAMPP menggunakan username `root` tanpa password. Sesuaikan jika Anda mengatur password sendiri.

#### 5. Buat Database di phpMyAdmin

1. Buka browser dan akses http://localhost/phpmyadmin.
2. Klik **New** di panel kiri.
3. Buat database baru dengan nama `si_evasi`.
4. Klik **Create**.

#### 6. Generate Application Key

```bash
php artisan key:generate
```

#### 7. Jalankan Migrasi & Seeder

```bash
php artisan migrate:fresh --seed
```

Perintah ini akan:
- Membuat semua tabel database secara otomatis.
- Mengisi data awal: **20 Polres se-Sulsel**, **36 pertanyaan kuesioner**, dan **15 responden dummy** untuk testing.

#### 8. Build Asset Frontend

```bash
npm run build
```

---

## Menjalankan Aplikasi

### Cara 1: Menggunakan PHP Built-in Server (Lebih Mudah)

```bash
php artisan serve
```

Buka browser dan akses: **http://127.0.0.1:8000**

### Cara 2: Melalui XAMPP (Apache)

Pastikan XAMPP sudah berjalan, lalu akses:

**http://localhost/SI-EVASI/public**

> Jika menggunakan cara ini, pastikan `APP_URL` di `.env` sudah diubah menjadi `http://localhost/SI-EVASI/public`.

---

## Akun Default

Setelah menjalankan seeder, gunakan akun berikut untuk login:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@sisakti.id` | `Admin@1234` |
| Evaluator | `evaluator@sisakti.id` | `Eval@1234` |

---

## Pengujian

Aplikasi ini dilengkapi dengan Feature Tests untuk memastikan integritas logika inti.

```bash
php artisan test
```

Test yang tersedia:

- **`SkoringTest`**: Verifikasi akurasi rumus System Usability Scale (SUS) dan pemetaan kategori.
- **`KuesionerFlowTest`**: Verifikasi alur pengisian dari Data Diri hingga Selesai.
- **`AuthRoleTest`**: Verifikasi hak akses antara Admin, Evaluator, dan Tamu.

---

## Troubleshooting

| Masalah | Solusi |
|---|---|
| `php: command not found` | Tambahkan `C:\xampp\php` ke PATH environment variable, lalu restart terminal. |
| `composer: command not found` | Reinstall Composer dari https://getcomposer.org/download. |
| Error koneksi database | Pastikan MySQL di XAMPP sudah **Start**, dan konfigurasi `.env` sudah benar. |
| Error `APP_KEY` kosong | Jalankan `php artisan key:generate`. |
| Halaman CSS/JS tidak tampil saat lewat XAMPP | Pastikan sudah menjalankan `npm run build`. |
| Error `Class not found` | Jalankan `composer dump-autoload`. |

---


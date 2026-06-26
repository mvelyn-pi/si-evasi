<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Evaluasi SAKTI</title>
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 9px; color: #1A2332; margin: 0; }
    h1 { font-size: 14px; font-weight: bold; text-align: center; margin: 0 0 4px; color: #1B3A5C; }
    .subtitle { text-align: center; font-size: 9px; color: #6B7A8D; margin-bottom: 12px; }
    .divider { border-top: 2px solid #1B3A5C; margin-bottom: 12px; }
    .metric-table { width: 100%; margin-bottom: 12px; }
    .metric-card { background: #F5F7FA; border: 1px solid #DDE3EC; border-radius: 6px; padding: 10px; text-align: center; }
    .metric-label { font-size: 8px; color: #6B7A8D; text-transform: uppercase; margin-bottom: 4px; font-weight: bold; }
    .metric-value { font-size: 14px; font-weight: bold; color: #1B3A5C; }
    .metric-sub { font-size: 9px; color: #6B7A8D; font-weight: normal; }
    .info-table { width: 100%; margin-bottom: 16px; border-collapse: collapse; }
    .info-table td { padding: 6px 12px; font-size: 9px; border: 1px solid #DDE3EC; background: #fff; }
    .info-table .info-label { width: 15%; background: #F5F7FA; color: #6B7A8D; font-weight: bold; }
    table.rekap { width: 100%; border-collapse: collapse; margin-top: 8px; }
    table.rekap th { background: #1B3A5C; color: #FFFFFF; padding: 5px 6px; font-size: 8px; text-align: center; border: 1px solid #1B3A5C; }
    table.rekap td { padding: 4px 6px; border-bottom: 1px solid #DDE3EC; font-size: 8px; border-left: 1px solid #DDE3EC; border-right: 1px solid #DDE3EC; }
    table.rekap tr:nth-child(even) { background: #F5F7FA; }
    .badge { padding: 2px 5px; border-radius: 3px; font-size: 7px; font-weight: bold; display: inline-block; }
    .badge-sangat-tinggi, .badge-sangat-baik { background: #eaf5f0; color: #2D9E6B; border: 1px solid #2D9E6B; }
    .badge-tinggi, .badge-baik { background: #ebf0f6; color: #2E6DA4; border: 1px solid #2E6DA4; }
    .badge-cukup { background: #fcf5e9; color: #E8A020; border: 1px solid #E8A020; }
    .badge-rendah { background: #f9ebea; color: #C0392B; border: 1px solid #C0392B; }
    .badge-sangat-rendah { background: #f9ebea; color: #C0392B; border: 1px solid #C0392B; }
    .footer { margin-top: 16px; text-align: center; font-size: 8px; color: #6B7A8D; border-top: 1px solid #DDE3EC; padding-top: 6px; }
    .text-center { text-align: center; }
</style>
</head>
<body>
<h1>LAPORAN EVALUASI APLIKASI SAKTI</h1>
<div class="subtitle">Sistem Evaluasi Berbasis Web — SI-EVASI | Polda Sulawesi Selatan</div>
<div class="divider"></div>

@php
    $avgP = $data->avg('skor_pemahaman');
    $avgS = $data->avg('skor_sus');
    $avgPU= $data->avg('skor_pu');
    $avgPE= $data->avg('skor_peou');
    $avgAT= $data->avg('skor_atu');
    $avgBI= $data->avg('skor_bi');
    $avgT = ($avgPU+$avgPE+$avgAT+$avgBI)/4;
@endphp

<table class="metric-table">
    <tr>
        <td style="width: 25%; padding-right: 4px;">
            <div class="metric-card">
                <div class="metric-label">Total Responden</div>
                <div class="metric-value">{{ $data->count() }} <span class="metric-sub">Orang</span></div>
            </div>
        </td>
        <td style="width: 25%; padding: 0 4px;">
            <div class="metric-card">
                <div class="metric-label">Rata-rata Pemahaman</div>
                <div class="metric-value">{{ number_format($avgP,2) }} <span class="metric-sub">/ 5.00</span></div>
            </div>
        </td>
        <td style="width: 25%; padding: 0 4px;">
            <div class="metric-card">
                <div class="metric-label">Rata-rata TAM</div>
                <div class="metric-value">{{ number_format($avgT,2) }} <span class="metric-sub">/ 5.00</span></div>
            </div>
        </td>
        <td style="width: 25%; padding-left: 4px;">
            <div class="metric-card">
                <div class="metric-label">Rata-rata SUS</div>
                <div class="metric-value">{{ number_format($avgS,1) }} <span class="metric-sub">/ 100</span></div>
            </div>
        </td>
    </tr>
</table>

<table class="info-table">
    <tr>
        <td class="info-label">Tanggal Cetak</td>
        <td style="width: 35%;">{{ now()->format('d F Y, H:i') }} WIB</td>
        <td class="info-label">Rincian Konstruk TAM</td>
        <td style="width: 35%;">
            <strong>PU:</strong> {{ number_format($avgPU,2) }} &nbsp;|&nbsp; 
            <strong>PEOU:</strong> {{ number_format($avgPE,2) }} &nbsp;|&nbsp; 
            <strong>ATU:</strong> {{ number_format($avgAT,2) }} &nbsp;|&nbsp; 
            <strong>BI:</strong> {{ number_format($avgBI,2) }}
        </td>
    </tr>
</table>

<table class="rekap">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Responden</th>
            <th>Polres</th>
            <th>Jabatan</th>
            <th>Pelatihan</th>
            <th>Pemahaman</th>
            <th>Kat. Pemahaman</th>
            <th>PU</th><th>PEOU</th><th>ATU</th><th>BI</th>
            <th>TAM</th>
            <th>Kat. TAM</th>
            <th>SUS</th>
            <th>Kat. SUS</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i => $h)
        @php
            $skorTam = $h->skor_pu && $h->skor_peou ? round(($h->skor_pu+$h->skor_peou+$h->skor_atu+$h->skor_bi)/4,2) : '-';
            $katPem = strtolower(str_replace(' ','-',$h->kategori_pemahaman??''));
            $katTam = strtolower(str_replace(' ','-',$h->kategori_tam??''));
            $katSus = strtolower(str_replace(' ','-',$h->kategori_sus??''));
        @endphp
        <tr>
            <td class="text-center">{{ $i+1 }}</td>
            <td class="text-center"><strong>{{ $h->responden->kode_responden }}</strong></td>
            <td>{{ $h->responden->polres->nama_polres ?? '-' }}</td>
            <td>{{ $h->responden->jabatan }}</td>
            <td class="text-center">{{ $h->responden->pelatihan_sakti }}</td>
            <td class="text-center">{{ number_format($h->skor_pemahaman,2) }}</td>
            <td class="text-center"><span class="badge badge-{{ $katPem }}">{{ $h->kategori_pemahaman }}</span></td>
            <td class="text-center">{{ number_format($h->skor_pu,2) }}</td>
            <td class="text-center">{{ number_format($h->skor_peou,2) }}</td>
            <td class="text-center">{{ number_format($h->skor_atu,2) }}</td>
            <td class="text-center">{{ number_format($h->skor_bi,2) }}</td>
            <td class="text-center">{{ is_numeric($skorTam) ? number_format($skorTam,2) : $skorTam }}</td>
            <td class="text-center"><span class="badge badge-{{ $katTam }}">{{ $h->kategori_tam }}</span></td>
            <td class="text-center">{{ number_format($h->skor_sus,1) }}</td>
            <td class="text-center"><span class="badge badge-{{ $katSus }}">{{ $h->kategori_sus }}</span></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    Dokumen ini dicetak secara otomatis oleh SI-EVASI — Sistem Evaluasi Aplikasi SAKTI | Bersifat Rahasia untuk Keperluan Penelitian
</div>
</body>
</html>

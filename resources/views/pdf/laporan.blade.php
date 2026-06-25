<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Evaluasi SAKTI</title>
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 9px; color: #1e293b; margin: 0; }
    h1 { font-size: 14px; font-weight: bold; text-align: center; margin: 0 0 4px; }
    .subtitle { text-align: center; font-size: 9px; color: #64748b; margin-bottom: 12px; }
    .divider { border-top: 2px solid #1e40af; margin-bottom: 12px; }
    .summary-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px 12px; margin-bottom: 12px; }
    .summary-box table { width: 100%; }
    .summary-box td { padding: 2px 8px; font-size: 9px; }
    .summary-box .label { color: #64748b; }
    .summary-box .value { font-weight: bold; color: #1e40af; }
    table.rekap { width: 100%; border-collapse: collapse; margin-top: 8px; }
    table.rekap th { background: #1e40af; color: #fff; padding: 5px 6px; font-size: 8px; text-align: center; }
    table.rekap td { padding: 4px 6px; border-bottom: 1px solid #f1f5f9; font-size: 8px; }
    table.rekap tr:nth-child(even) { background: #f8fafc; }
    .badge { padding: 1px 5px; border-radius: 3px; font-size: 7px; font-weight: bold; }
    .badge-sangat-tinggi, .badge-sangat-baik { background: #d1fae5; color: #065f46; }
    .badge-tinggi, .badge-baik { background: #dbeafe; color: #1e40af; }
    .badge-cukup { background: #fef9c3; color: #854d0e; }
    .badge-rendah { background: #fee2e2; color: #991b1b; }
    .badge-sangat-rendah { background: #fce7f3; color: #9d174d; }
    .footer { margin-top: 16px; text-align: center; font-size: 8px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 6px; }
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

<div class="summary-box">
    <table>
        <tr>
            <td class="label">Total Responden</td>
            <td class="value">{{ $data->count() }}</td>
            <td class="label">Rata-rata Pemahaman</td>
            <td class="value">{{ number_format($avgP,2) }}/5.00</td>
            <td class="label">Rata-rata TAM</td>
            <td class="value">{{ number_format($avgT,2) }}/5.00</td>
            <td class="label">Rata-rata SUS</td>
            <td class="value">{{ number_format($avgS,1) }}/100</td>
        </tr>
        <tr>
            <td class="label">Tanggal Cetak</td>
            <td class="value" colspan="3">{{ now()->format('d F Y, H:i') }} WIB</td>
            <td class="label">Konstruk TAM (PU/PEOU/ATU/BI)</td>
            <td class="value" colspan="3">{{ number_format($avgPU,2) }} / {{ number_format($avgPE,2) }} / {{ number_format($avgAT,2) }} / {{ number_format($avgBI,2) }}</td>
        </tr>
    </table>
</div>

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

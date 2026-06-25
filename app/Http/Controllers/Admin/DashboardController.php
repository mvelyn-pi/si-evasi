<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilEvaluasi;
use App\Models\Polres;
use App\Models\Responden;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalResponden = Responden::count();
        $totalPolres    = Polres::count();

        $avgPemahaman = HasilEvaluasi::avg('skor_pemahaman');
        $avgSUS       = HasilEvaluasi::avg('skor_sus');
        $avgPU        = HasilEvaluasi::avg('skor_pu');
        $avgPEOU      = HasilEvaluasi::avg('skor_peou');
        $avgATU       = HasilEvaluasi::avg('skor_atu');
        $avgBI        = HasilEvaluasi::avg('skor_bi');

        $avgTAM = ($avgPU + $avgPEOU + $avgATU + $avgBI) > 0
            ? round(($avgPU + $avgPEOU + $avgATU + $avgBI) / 4, 2)
            : 0;

        // Data per Polres untuk chart
        $dataPerPolres = DB::table('hasil_evaluasis')
            ->join('respondens', 'hasil_evaluasis.id_responden', '=', 'respondens.id_responden')
            ->join('polres', 'respondens.id_polres', '=', 'polres.id_polres')
            ->select(
                'polres.nama_polres',
                DB::raw('ROUND(AVG(hasil_evaluasis.skor_pemahaman), 2) as avg_pemahaman'),
                DB::raw('ROUND(AVG((hasil_evaluasis.skor_pu + hasil_evaluasis.skor_peou + hasil_evaluasis.skor_atu + hasil_evaluasis.skor_bi) / 4), 2) as avg_tam'),
                DB::raw('ROUND(AVG(hasil_evaluasis.skor_sus), 2) as avg_sus'),
                DB::raw('COUNT(*) as jumlah_responden')
            )
            ->groupBy('polres.id_polres', 'polres.nama_polres')
            ->orderBy('polres.nama_polres')
            ->get();

        // Distribusi kategori SUS
        $distribusiSUS = HasilEvaluasi::whereNotNull('kategori_sus')
            ->select('kategori_sus', DB::raw('count(*) as jumlah'))
            ->groupBy('kategori_sus')
            ->get();

        // Rekapitulasi tabel
        $rekap = HasilEvaluasi::with(['responden.polres'])
            ->orderBy('id_hasil')
            ->paginate(20);

        return view('admin.dashboard', compact(
            'totalResponden', 'totalPolres',
            'avgPemahaman', 'avgSUS', 'avgTAM',
            'avgPU', 'avgPEOU', 'avgATU', 'avgBI',
            'dataPerPolres', 'distribusiSUS', 'rekap'
        ));
    }
}

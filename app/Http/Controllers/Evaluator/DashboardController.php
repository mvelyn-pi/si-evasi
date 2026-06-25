<?php

namespace App\Http\Controllers\Evaluator;

use App\Http\Controllers\Controller;
use App\Models\HasilEvaluasi;
use App\Models\Polres;
use App\Models\Responden;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalResponden = Responden::count();
        $totalPolres    = Polres::count();

        $avgPemahaman = round(HasilEvaluasi::avg('skor_pemahaman') ?? 0, 2);
        $avgSUS       = round(HasilEvaluasi::avg('skor_sus') ?? 0, 2);
        $avgPU        = round(HasilEvaluasi::avg('skor_pu') ?? 0, 2);
        $avgPEOU      = round(HasilEvaluasi::avg('skor_peou') ?? 0, 2);
        $avgATU       = round(HasilEvaluasi::avg('skor_atu') ?? 0, 2);
        $avgBI        = round(HasilEvaluasi::avg('skor_bi') ?? 0, 2);
        $avgTAM       = ($avgPU + $avgPEOU + $avgATU + $avgBI) > 0
            ? round(($avgPU + $avgPEOU + $avgATU + $avgBI) / 4, 2)
            : 0;

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

        $distribusiSUS = HasilEvaluasi::whereNotNull('kategori_sus')
            ->select('kategori_sus', DB::raw('count(*) as jumlah'))
            ->groupBy('kategori_sus')
            ->get();

        $rekap = HasilEvaluasi::with(['responden.polres'])
            ->orderBy('id_hasil')
            ->paginate(20);

        return view('evaluator.dashboard', compact(
            'totalResponden', 'totalPolres',
            'avgPemahaman', 'avgSUS', 'avgTAM',
            'avgPU', 'avgPEOU', 'avgATU', 'avgBI',
            'dataPerPolres', 'distribusiSUS', 'rekap'
        ));
    }
}

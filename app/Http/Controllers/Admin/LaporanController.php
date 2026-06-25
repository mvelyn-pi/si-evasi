<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\LaporanExport;
use App\Models\HasilEvaluasi;
use App\Models\Polres;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilEvaluasi::with(['responden.polres'])
            ->whereNotNull('skor_sus');

        // Filter
        if ($request->filled('id_polres')) {
            $query->whereHas('responden', fn($q) => $q->where('id_polres', $request->id_polres));
        }
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        $data     = $query->paginate(25)->withQueryString();
        $polresList = Polres::orderBy('nama_polres')->get();

        return view('admin.laporan.index', compact('data', 'polresList'));
    }

    public function exportPdf(Request $request)
    {
        $query = HasilEvaluasi::with(['responden.polres'])
            ->whereNotNull('skor_sus');

        if ($request->filled('id_polres')) {
            $query->whereHas('responden', fn($q) => $q->where('id_polres', $request->id_polres));
        }

        $data = $query->get();

        $pdf = Pdf::loadView('pdf.laporan', compact('data'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Laporan_Evaluasi_SAKTI_' . now()->format('Ymd_His') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new LaporanExport($request->id_polres),
            'Laporan_Evaluasi_SAKTI_' . now()->format('Ymd_His') . '.xlsx'
        );
    }
}

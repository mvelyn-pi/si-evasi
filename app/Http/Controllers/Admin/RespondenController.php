<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Polres;
use App\Models\Responden;
use Illuminate\Http\Request;

class RespondenController extends Controller
{
    public function index(Request $request)
    {
        $polresList = Polres::orderBy('nama_polres')->get();

        $respondens = Responden::with(['polres', 'hasilEvaluasi'])
            ->when($request->filled('id_polres'), function ($query) use ($request) {
                $query->where('id_polres', $request->input('id_polres'));
            })
            ->when($request->filled('tanggal_mulai'), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->input('tanggal_mulai'));
            })
            ->when($request->filled('tanggal_akhir'), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->input('tanggal_akhir'));
            })
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.responden.index', compact('respondens', 'polresList'));
    }

    public function show(Responden $responden)
    {
        $responden->load(['polres', 'hasilEvaluasi', 'jawabans.pertanyaan']);
        return view('admin.responden.show', compact('responden'));
    }

    public function destroy(Responden $responden)
    {
        $responden->delete();
        return redirect()->route('admin.responden.index')
            ->with('success', 'Data responden berhasil dihapus.');
    }
}

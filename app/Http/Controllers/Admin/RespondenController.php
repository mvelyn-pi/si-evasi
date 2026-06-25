<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Responden;

class RespondenController extends Controller
{
    public function index()
    {
        $respondens = Responden::with(['polres', 'hasilEvaluasi'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.responden.index', compact('respondens'));
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

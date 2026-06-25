<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        $pemahaman = Pertanyaan::jenis('pemahaman')->orderBy('nomor_item')->get();
        $tam       = Pertanyaan::jenis('tam')->orderBy('nomor_item')->get();
        $sus       = Pertanyaan::jenis('sus')->orderBy('nomor_item')->get();

        return view('admin.pertanyaan.index', compact('pemahaman', 'tam', 'sus'));
    }

    public function create()
    {
        return view('admin.pertanyaan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kuesioner'  => 'required|in:pemahaman,tam,sus',
            'konstruk'         => 'nullable|string|max:100',
            'nomor_item'       => 'required|integer|min:1',
            'teks_pertanyaan'  => 'required|string',
            'is_reverse'       => 'boolean',
            'status'           => 'required|in:aktif,nonaktif',
        ]);

        $validated['is_reverse'] = $request->boolean('is_reverse');

        Pertanyaan::create($validated);

        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(Pertanyaan $pertanyaan)
    {
        return view('admin.pertanyaan.edit', compact('pertanyaan'));
    }

    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $validated = $request->validate([
            'jenis_kuesioner'  => 'required|in:pemahaman,tam,sus',
            'konstruk'         => 'nullable|string|max:100',
            'nomor_item'       => 'required|integer|min:1',
            'teks_pertanyaan'  => 'required|string',
            'is_reverse'       => 'boolean',
            'status'           => 'required|in:aktif,nonaktif',
        ]);

        $validated['is_reverse'] = $request->boolean('is_reverse');

        $pertanyaan->update($validated);

        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();
        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }

    /** Toggle status aktif/nonaktif */
    public function toggleStatus(Pertanyaan $pertanyaan)
    {
        $pertanyaan->update([
            'status' => $pertanyaan->status === 'aktif' ? 'nonaktif' : 'aktif',
        ]);

        return back()->with('success', 'Status pertanyaan diperbarui.');
    }
}

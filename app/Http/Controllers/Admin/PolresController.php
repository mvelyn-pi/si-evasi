<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Polres;
use Illuminate\Http\Request;

class PolresController extends Controller
{
    public function index()
    {
        $polresList = Polres::withCount('respondens')->orderBy('nama_polres')->paginate(15);
        return view('admin.polres.index', compact('polresList'));
    }

    public function create()
    {
        return view('admin.polres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_polres' => 'required|string|max:150|unique:polres,nama_polres',
            'wilayah'     => 'required|string|max:100',
        ]);

        Polres::create($validated);

        return redirect()->route('admin.polres.index')
            ->with('success', 'Data Polres berhasil ditambahkan.');
    }

    public function edit(Polres $polre)
    {
        return view('admin.polres.edit', ['polres' => $polre]);
    }

    public function update(Request $request, Polres $polre)
    {
        $validated = $request->validate([
            'nama_polres' => 'required|string|max:150|unique:polres,nama_polres,' . $polre->id_polres . ',id_polres',
            'wilayah'     => 'required|string|max:100',
        ]);

        $polre->update($validated);

        return redirect()->route('admin.polres.index')
            ->with('success', 'Data Polres berhasil diperbarui.');
    }

    public function destroy(Polres $polre)
    {
        $polre->delete();
        return redirect()->route('admin.polres.index')
            ->with('success', 'Data Polres berhasil dihapus.');
    }
}

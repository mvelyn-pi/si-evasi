<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Pertanyaan;
use App\Models\Polres;
use App\Models\Responden;
use App\Services\SkoringService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuesionerController extends Controller
{
    public function __construct(private SkoringService $skoringService)
    {}

    /** Landing page */
    public function index()
    {
        return view('kuesioner.welcome');
    }

    /** Form data diri responden */
    public function mulai()
    {
        $polresList = Polres::orderBy('nama_polres')->get();
        return view('kuesioner.mulai', compact('polresList'));
    }

    /** Simpan data diri dan generate kode responden */
    public function storeMulai(Request $request)
    {
        $validated = $request->validate([
            'id_polres'           => 'required|exists:polres,id_polres',
            'jabatan'             => 'required|string|max:100',
            'lama_penggunaan'     => 'required|string|max:50',
            'frekuensi_penggunaan'=> 'required|string|max:50',
            'pelatihan_sakti'     => 'required|in:Pernah,Belum',
        ]);

        // Generate kode responden unik: RSP-XXXX
        $count = Responden::count() + 1;
        $kode  = 'RSP-' . str_pad($count, 4, '0', STR_PAD_LEFT);

        // Pastikan kode unik (jika ada duplikat)
        while (Responden::where('kode_responden', $kode)->exists()) {
            $count++;
            $kode = 'RSP-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        }

        $responden = Responden::create([
            ...$validated,
            'kode_responden' => $kode,
        ]);

        return redirect()->route('kuesioner.pemahaman', $kode);
    }

    /** Form kuesioner Pemahaman */
    public function pemahaman(string $kode)
    {
        $responden  = Responden::where('kode_responden', $kode)->firstOrFail();
        $pertanyaans = Pertanyaan::aktif()->jenis('pemahaman')->orderBy('nomor_item')->get();

        if ($responden->sudahIsi('pemahaman')) {
            return redirect()->route('kuesioner.tam', $kode)
                ->with('info', 'Anda sudah mengisi kuesioner Pemahaman. Lanjutkan ke TAM.');
        }

        return view('kuesioner.pemahaman', compact('responden', 'pertanyaans'));
    }

    /** Submit jawaban kuesioner Pemahaman */
    public function storePemahaman(Request $request, string $kode)
    {
        $responden   = Responden::where('kode_responden', $kode)->firstOrFail();
        $pertanyaans = Pertanyaan::aktif()->jenis('pemahaman')->get();

        $rules = [];
        foreach ($pertanyaans as $p) {
            $rules['jawaban.' . $p->id_pertanyaan] = 'required|integer|between:1,5';
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($responden, $validated) {
            foreach ($validated['jawaban'] as $idPertanyaan => $skor) {
                Jawaban::updateOrCreate(
                    ['id_responden' => $responden->id_responden, 'id_pertanyaan' => $idPertanyaan],
                    ['skor' => $skor]
                );
            }
            $this->skoringService->simpanHasilEvaluasi($responden->id_responden);
        });

        return redirect()->route('kuesioner.tam', $kode)
            ->with('success', 'Kuesioner Pemahaman berhasil disimpan!');
    }

    /** Form kuesioner TAM */
    public function tam(string $kode)
    {
        $responden   = Responden::where('kode_responden', $kode)->firstOrFail();
        $pertanyaans = Pertanyaan::aktif()->jenis('tam')->orderBy('nomor_item')->get();

        if (!$responden->sudahIsi('pemahaman')) {
            return redirect()->route('kuesioner.pemahaman', $kode)
                ->with('warning', 'Silakan isi kuesioner Pemahaman terlebih dahulu.');
        }

        if ($responden->sudahIsi('tam')) {
            return redirect()->route('kuesioner.sus', $kode)
                ->with('info', 'Anda sudah mengisi kuesioner TAM. Lanjutkan ke SUS.');
        }

        // Kelompokkan per konstruk untuk tampilan yang lebih baik
        $kelompok = $pertanyaans->groupBy('konstruk');

        return view('kuesioner.tam', compact('responden', 'pertanyaans', 'kelompok'));
    }

    /** Submit jawaban kuesioner TAM */
    public function storeTam(Request $request, string $kode)
    {
        $responden   = Responden::where('kode_responden', $kode)->firstOrFail();
        $pertanyaans = Pertanyaan::aktif()->jenis('tam')->get();

        $rules = [];
        foreach ($pertanyaans as $p) {
            $rules['jawaban.' . $p->id_pertanyaan] = 'required|integer|between:1,5';
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($responden, $validated) {
            foreach ($validated['jawaban'] as $idPertanyaan => $skor) {
                Jawaban::updateOrCreate(
                    ['id_responden' => $responden->id_responden, 'id_pertanyaan' => $idPertanyaan],
                    ['skor' => $skor]
                );
            }
            $this->skoringService->simpanHasilEvaluasi($responden->id_responden);
        });

        return redirect()->route('kuesioner.sus', $kode)
            ->with('success', 'Kuesioner TAM berhasil disimpan!');
    }

    /** Form kuesioner SUS */
    public function sus(string $kode)
    {
        $responden   = Responden::where('kode_responden', $kode)->firstOrFail();
        $pertanyaans = Pertanyaan::aktif()->jenis('sus')->orderBy('nomor_item')->get();

        if (!$responden->sudahIsi('tam')) {
            return redirect()->route('kuesioner.tam', $kode)
                ->with('warning', 'Silakan isi kuesioner TAM terlebih dahulu.');
        }

        if ($responden->sudahIsi('sus')) {
            return redirect()->route('kuesioner.selesai')
                ->with('info', 'Anda sudah menyelesaikan semua kuesioner.');
        }

        return view('kuesioner.sus', compact('responden', 'pertanyaans'));
    }

    /** Submit jawaban kuesioner SUS */
    public function storeSus(Request $request, string $kode)
    {
        $responden   = Responden::where('kode_responden', $kode)->firstOrFail();
        $pertanyaans = Pertanyaan::aktif()->jenis('sus')->get();

        $rules = [];
        foreach ($pertanyaans as $p) {
            $rules['jawaban.' . $p->id_pertanyaan] = 'required|integer|between:1,5';
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($responden, $validated) {
            foreach ($validated['jawaban'] as $idPertanyaan => $skor) {
                Jawaban::updateOrCreate(
                    ['id_responden' => $responden->id_responden, 'id_pertanyaan' => $idPertanyaan],
                    ['skor' => $skor]
                );
            }
            // Simpan hasil evaluasi final setelah semua kuesioner selesai
            $this->skoringService->simpanHasilEvaluasi($responden->id_responden);
        });

        return redirect()->route('kuesioner.selesai')
            ->with('kode_responden', $kode);
    }

    /** Halaman selesai */
    public function selesai(Request $request)
    {
        $kode = session('kode') ?? $request->query('kode');
        return view('kuesioner.selesai', compact('kode'));
    }
}

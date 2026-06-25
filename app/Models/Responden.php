<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Responden extends Model
{
    use HasFactory;

    protected $table = 'respondens';
    protected $primaryKey = 'id_responden';

    protected $fillable = [
        'kode_responden',
        'id_polres',
        'jabatan',
        'lama_penggunaan',
        'frekuensi_penggunaan',
        'pelatihan_sakti',
    ];

    public function polres(): BelongsTo
    {
        return $this->belongsTo(Polres::class, 'id_polres', 'id_polres');
    }

    public function jawabans(): HasMany
    {
        return $this->hasMany(Jawaban::class, 'id_responden', 'id_responden');
    }

    public function hasilEvaluasi(): HasOne
    {
        return $this->hasOne(HasilEvaluasi::class, 'id_responden', 'id_responden');
    }

    public function sudahIsi(string $jenis): bool
    {
        return $this->jawabans()
            ->whereHas('pertanyaan', fn($q) => $q->where('jenis_kuesioner', $jenis))
            ->exists();
    }

    public function sudahIsiSemua(): bool
    {
        return $this->sudahIsi('pemahaman')
            && $this->sudahIsi('tam')
            && $this->sudahIsi('sus');
    }
}
